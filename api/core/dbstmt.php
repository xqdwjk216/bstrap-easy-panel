<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dbstmt
{

	public $table_name;
	public $columns;
	public $columns_assoc;
	public $pdo_instance;
	public $pdo_stmt;
	public $bind_fields = [];
	public $bind_field_value = [];
	public $bind_where;
	public $sql;
	public $page_no;
	public $page_size;
	public $page_total;

	public function page($page_no = 1, $page_size = 20)
	{
		$this->page_size = $page_size;
		$count = $this->count();
		$this->page_total = ceil($count / $this->page_size);
		if ($page_no > $this->page_total)
		{
			$this->page_no = $this->page_total;
		}
		else
		{
			$this->page_no = $page_no;
		}
		$this->sql .= " limit " . ($this->page_no - 1) * $page_size . "," . $page_size;
		$this->prepare($this->sql);
		return $this;
	}

	public function fetch($sql = "")
	{
		if ($sql)
		{
			$this->query($sql);
		}
		return !$this->pdo_stmt ? false : $this->pdo_stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function fetchCol($sql = "", $idx = 0)
	{
		if ($sql)
		{
			$this->query($sql);
		}
		return !$this->pdo_stmt ? NULL : $this->pdo_stmt->fetchColumn($idx);
	}

	public function fetchAll($sql = "")
	{
		if ($sql)
		{
			$this->query($sql);
		}
		return !$this->pdo_stmt ? array() : $this->pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function fetchAllAssoc($sql, $idx_field = "")
	{
		if ($sql)
		{
			$this->query($sql);
		}
		$result = [];
		if (!$this->pdo_stmt)
		{
			return $result;
		}
		$set_arr_map = [];
		while ($row = $this->pdo_stmt->fetch(PDO::FETCH_ASSOC))
		{
			if ($idx_field && isset($row[$idx_field]))
			{
				if (!isset($result[$row[$idx_field]]))
				{
					$result[$row[$idx_field]] = $row;
				}
				else
				{
					if (!isset($set_arr_map[$row[$idx_field]]))
					{
						$result[$row[$idx_field]] = array($result[$row[$idx_field]]);
						$set_arr_map[$row[$idx_field]] = 1;
					}
					$result[$row[$idx_field]][] = $row;
				}
			}
			else
			{
				$result[] = $row;
			}
		}
		return $result;
	}

	public function getCols($sql = "")
	{
		if (!$this->pdo_stmt)
		{
			$this->query($sql);
		}

		$result = [];
		$c_count = $this->pdo_stmt->columnCount();
		for ($i = 0; $i < $c_count; $i++)
		{
			$result[] = $this->pdo_stmt->getColumnMeta($i)['name'];
		}
		return $result;
	}

	public function lastInsertId()
	{
		return $this->pdo_instance->lastInsertId();
	}

	public function query($sql)
	{
		$this->pdo_stmt = $this->pdo_instance->query($sql);
		$this->sql = $sql;
		if (!$this->pdo_stmt)
		{
			$errInfo = $this->pdo_instance->errorInfo();
			if (!empty($errInfo))
			{
				throw new Exception($errInfo[2], $errInfo[0]);
			}
		}
		return $this;
	}

	public function prepare($sql)
	{
		$this->sql = $sql;
		$this->pdo_stmt = $this->pdo_instance->prepare($sql);
		return $this;
	}

	public function cond()
	{
		$field_arr = explode(",", func_get_args()[0]);
		$this->bind_fields = array_unique($field_arr + $this->bind_fields);
		$fields = implode(",", $this->bind_fields);
		$where = "";
		foreach ($this->bind_fields as $v)
		{
			$where .= " and $v=:$v";
		}
		$this->bind_where = $where;
		$this->prepare("select $fields from " . $this->table_name . " where 1$where");
		return $this;
	}

	public function field()
	{
		$args = func_get_args();
		if (count($args) == 1)
		{
			$field_arr = explode(",", $args[0]);
		}
		else
		{
			$field_arr = &$args;
		}
		$this->bind_fields = array_unique($field_arr + $this->bind_fields);
		$fields = implode(",", $this->bind_fields);
		$sql = "select $fields from " . $this->table_name . " where 1" . $this->bind_where;

		$this->prepare($sql);
		return $this;
	}

	public function update($update_arr = [])
	{
		$this->exec();
		$c_count = $this->pdo_stmt->columnCount();
		$real_update_arr = [];
		$set = "";
		for ($i = 0; $i < $c_count; $i++)
		{
			$meta = $this->pdo_stmt->getColumnMeta($i);
			$name = $meta['name'];
			$type = $meta['native_type'];
			if (!isset($update_arr[$name]))
			{
				continue;
			}

			if (in_array(strtolower($type), ["long", "int"]))
			{
				$update_arr[] = intval($update_arr[$name]);
			}
			else if (in_array(strtolower($type), ["float", "decimal", "numeric"]))
			{
				$update_arr[] = doubleval($update_arr[$name]);
			}
			else
			{
				$update_arr[] = addslashes(strval($update_arr[$name]));
			}
			if (isset($update_arr[$name]))
			{
				$real_update_arr[] = $name . "='" . $update_arr[$name] . "'";
			}
		}

		if (empty($real_update_arr))
		{
			return false;
		}
		$sql = "update " . $this->table_name . " set " . implode(",", $real_update_arr) . " where 1 " . $this->bind_where;
		$ret = $this->prepare($sql)->exec($this->bind_field_value)->rowCount();
		return $ret;
	}

	public function rowCount()
	{
		return $this->pdo_stmt->rowCount();
	}

	public function bindInt($key, $value)
	{
		$this->bind_field_value[$key] = $value;
		$this->pdo_stmt->bindValue(":$key", intval($value), PDO::PARAM_INT);
		return $this;
	}

	public function bindStr($key, $value)
	{
		$this->bind_field_value[$key] = $value;
		$this->pdo_stmt->bindValue(":$key", $value, PDO::PARAM_STR);
		return $this;
	}

	public function exec($param = NULL)
	{
		if ($param)
		{
			$exec_result = $this->pdo_stmt->execute($param);
		}
		else
		{
			$exec_result = $this->pdo_stmt->execute();
		}
		if (!$exec_result)
		{
			$err_info = $this->pdo_stmt->errorInfo();
			if (!empty($err_info))
			{
				$this->debugDumpParams(true);
				throw new Exception(implode("|", $err_info), __LINE__);
			}
		}
		return $this;
	}

	public function debugDumpParams()
	{
		$this->pdo_stmt->debugDumpParams();
	}

	public function count()
	{
		$sql_cnt = preg_replace("/select\s+(.+)\s+from\s+(.+)(limit.*)?/i", "select count(1) from $2", $this->sql);
		$pdo_stmt = $this->pdo_instance->query($sql_cnt);
		if (!$pdo_stmt)
		{
			$errInfo = $this->pdo_instance->errorInfo();
			if (!empty($errInfo))
			{
				throw new Exception($errInfo[2], $errInfo[0]);
			}
		}

		return $pdo_stmt->fetchColumn(0);
	}

}
