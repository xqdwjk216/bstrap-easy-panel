<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dbstmt {

    public $table_name;
    public $columns;
    public $columns_assoc;
    public $pdo_instance;
    public $pdo_stmt;
    public $bind_fields = [];
    public $bind_where;

    public function fetch($sql = "") {
        if ($sql) {
            $this->query($sql);
        }
        return !$this->pdo_stmt ? false : $this->pdo_stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchCol($sql = "", $idx = 0) {
        if ($sql) {
            $this->query($sql);
        }
        return !$this->pdo_stmt ? NULL : $this->pdo_stmt->fetchColumn($idx);
    }

    public function fetchAll($sql = "") {
        if ($sql) {
            $this->query($sql);
        }
        return !$this->pdo_stmt ? array() : $this->pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchAllAssoc($idx_field = "") {
        $result = [];
        if (!$this->pdo_stmt) {
            return $result;
        }
        while ($row = $this->pdo_stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($idx_field && isset($row[$idx_field])) {
                $result[$row[$idx_field]] = $row;
            } else {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getCols($sql) {
        $result = [];
        $this->query($sql);

        if (!$this->pdo_stmt) {
            return $result;
        }

        $c_count = $this->pdo_stmt->columnCount();
        for ($i = 0; $i < $c_count; $i++) {
            $result[] = $this->pdo_stmt->getColMeta($i)['name'];
        }
        return $result;
    }

    public function lastInsertId() {
        return $this->pdo_instance->lastInsertId();
    }

    public function query($sql) {
        $this->pdo_stmt = $this->pdo_instance->query($sql);
        if (!$this->pdo_stmt) {
            $errInfo = $this->pdo_instance->errorInfo();
            if (!empty($errInfo)) {
                throw new Exception($errInfo[2], $errInfo[0]);
            }
        }
        return $this;
    }

    private function prepare($sql) {
        $this->pdo_stmt = $this->pdo_instance->prepare($sql);
        return $this;
    }

    public function cond() {
        $field_arr = explode(",", func_get_args()[0]);
        $this->bind_fields = array_unique($field_arr + $this->bind_fields);
        $fields = implode(",", $this->bind_fields);
        $where = "";
        foreach ($this->bind_fields as $v) {
            $where .= " and $v=:$v";
        }
        $this->bind_where = $where;
        $this->prepare("select $fields from " . $this->table_name . " where 1$where");
        return $this;
    }

    public function field() {
        $field_arr = explode(",", func_get_args()[0]);
        $this->bind_fields = array_unique($field_arr + $this->bind_fields);
        $fields = implode(",", $this->bind_fields);
        $this->prepare("select $fields from " . $this->table_name . " where 1" . $this->bind_where);
        return $this;
    }

    public function bindInt($key, $value) {
        $this->pdo_stmt->bindValue(":$key", intval($value), PDO::PARAM_INT);
        return $this;
    }

    public function bindStr($key, $value) {
        $this->pdo_stmt->bindValue(":$key", $value, PDO::PARAM_STR);
        return $this;
    }

    public function exec($param = NULL) {
        if ($param) {
            $this->pdo_stmt->execute($param);
        } else {
            $this->pdo_stmt->execute();
        }
        return $this;
    }

    public function debugDumpParams() {
        $this->pdo_stmt->debugDumpParams();
    }

}
