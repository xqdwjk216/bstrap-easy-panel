<?php

class MenuModel extends BaseModel
{

	public function listMenuItem()
	{

		$sql = "select b.*,a.name as 'parent_name' from module a join module b on b.parent_id=a.id";
		$list = Db::init()->fetchAllAssoc($sql, "parent_id");
		return $list;
	}

	public function listMenu()
	{

		$sql = "select * from module where parent_id=0";
		$list = Db::init()->fetchAllAssoc($sql, "id");
		return $list;
	}

	public function find($id = 0)
	{

		$sql = "select b.*,a.name as 'parent_name' from module a join module b on b.parent_id=a.id where b.id=:id";
		$row = Db::table("module")->prepare($sql)->bindInt("id", $id)->exec()->fetchAll();
		return $row;
	}

}
