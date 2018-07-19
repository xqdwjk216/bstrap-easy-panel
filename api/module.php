<?php

class ModuleApi extends Api
{

	public function delete()
	{
		$id = Input::request("id", 0, "intval");
		Db::init()->query("delete from module where id=$id");
		$this->succExit();
	}

	public function save()
	{
		$param = Input::request();
		$user = Db::table("module")->cond("id")->field("*")->bindInt("id", intval($param["id"]))->exec()->fetch();
		$diff = array_diff($param, $user);
		$rowCount = Db::table("module")->cond("id")->field("*")->bindInt("id", intval($param["id"]))->update($diff);
		$this->succExit(["rowCount" => $rowCount]);
	}

}
