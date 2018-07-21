<?php

class View
{

	var $html = "";
	var $tag = "";
	var $style = "";
	var $id = "";
	var $class = "";
	var $body = "";
	var $db_stmt = "";
	var $attr = "";
	var $base_url = "";

	public function setBaseUrl($base_url = "")
	{
		$this->base_url = trim($base_url, "/");
		return $this;
	}

	public function setTag($tag)
	{
		$this->tag = $tag;
		return $this;
	}

	public function setPageSize($page_size)
	{
		$this->page_size = $page_size;
	}

	public function setPageNo($page_no)
	{
		$this->page_no = $page_no;
	}

	public function setId($id = "")
	{
		$this->id = $id;
		return $this;
	}

	public function setClass($class = "")
	{
		$this->class = $class;
		return $this;
	}

	public function setStyle($style = "")
	{
		$this->style = $style;
		return $this;
	}

	public function attr()
	{
		$args = func_get_args();
		if( empty($args) ){
			return $this;
		}
		$key = $args[0];
		if (count($args) == 1)
		{
			return isset($this->attrs[$key]) ? $this->attrs[$key] : "";
		}
		$this->attrs[$key] = $args[1];
		return $this;
	}

	public function html()
	{
		if (!$this->html)
		{
			if ($this->id)
			{
				$this->html .= ' id="' . $this->id . '"';
			}
			if ($this->class)
			{
				$this->html .= ' class="' . $this->class . '"';
			}
			if ($this->style)
			{
				$this->html .= ' style="' . $this->style . '"';
			}
			if (!empty($this->attrs))
			{
				foreach ($this->attrs as $key => $attr)
				{
					$this->html .= ' ' . $key . '="' . $attr . '"';
				}
			}
			$this->html = sprintf('<%s%s>%s</%s>', $this->tag, $this->html, $this->body, $this->tag);
		}
		return $this->html;
	}

	public function bindDbStmt($db_stmt)
	{
		$this->db_stmt = $db_stmt;
		return $this;
	}

	public function setBody($body = "")
	{
		$this->body = $body;
		return $this;
	}

	public function getBody($iterator = NULL)
	{
		switch ($this->tag)
		{
			case "table":
				$cols = $this->db_stmt->exec()->getCols();
				$thead = new View();
				$thead->setTag("thead");

				$tr = new View();
				$tr->setTag("tr");
				foreach ($cols as $col)
				{
					$td = new View();
					$td->setTag("td")->setBody($col);
					$tr->append($td);
				}
				$thead->append($tr);

				$tbody = new View();
				$tbody->setTag("tbody");
				$arrList = $this->db_stmt->fetchAll();
				foreach ($arrList as $row)
				{
					$tr = new View();
					$tr->setTag("tr");
					foreach ($cols as $col)
					{
						if (strtoupper($row[$col]) == '__H__')
						{
							continue;
						}
						$td = new View();
						$td->attr("data-col", $col);
						$td->setTag("td")->setBody($row[$col]);
						$tr->append($td);
					}
					if ($iterator)
					{
						$iterator($row, $tr);
					}
					$tbody->append($tr);
				}
				$this->body = $thead->html() . $tbody->html();
				break;
			case "nav":
				$ul = new View();
				$ul->setTag("ul")->setClass("pagination pagination-sm");
				$page_total = $this->db_stmt->page_total;
				$page_start = 1;
				if ($this->db_stmt->page_no > 3)
				{
					$page_start = $this->db_stmt->page_no - 2;
				}
				$page_end = $page_start + 4;
				if ($page_end > $page_total)
				{
					$page_end = $page_total;
				}

				$page = $this->db_stmt->page_no > 1 ? $this->db_stmt->page_no - 1 : 1;
				$li = (new View)->setTag("li")
						->append(
						(new View)->setTag("a")
						->attr("href", $this->base_url . "/page_no:$page")
						->append(
								(new View)->setTag("span")->setBody("«")
						)
				);
				if ($page == 1)
				{
					$li->setClass("disabled")->attr("href", "#");
				}
				$ul->append($li);

				for ($i = $page_start; $i <= $page_end; $i++)
				{
					$li = (new View)->setTag("li")
							->append(
							(new View)->setTag("a")
							->attr("href", $this->base_url . "/page_no:$i")
							->append(
									(new View)->setTag("span")->setBody($i)
							)
					);
					if ($this->db_stmt->page_no == $i)
					{
						$li->setClass("active");
					}
					$ul->append($li);
				}

				$page = $this->db_stmt->page_no >= $page_total ? $page_total : $this->db_stmt->page_no + 1;
				$li = (new View)->setTag("li")
						->append(
						(new View)->setTag("a")
						->attr("href", $this->base_url . "/page_no:$page")
						->append(
								(new View)->setTag("span")->setBody("»")
						)
				);
				if ($this->db_stmt->page_no == $page_total)
				{

					$li->setClass("disabled")->attr("href", "#");
				}
				$ul->append($li);

				$this->body = $ul->html();
				break;
		}

		return $this;
	}

	public function table()
	{
		$this->setTag("table");
		return $this;
	}

	public function td()
	{
		$this->setTag("td");
		return $this;
	}

	public function append($node)
	{ 
		if( !is_object($node)){
			debug_print_backtrace();
			exit;
		}
		$this->body .= $node->html();
		return $this;
	}

	public function after($node)
	{
		$this->html .= $node->html();
		return $this;
	}

	public function before($node)
	{
		$this->html = $this->html . $node->html();
		return $this;
	}

}
