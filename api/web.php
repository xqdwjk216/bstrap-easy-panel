<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebApi extends Api
{

	public function index()
	{
		$m = Input::request('m');
		$v = Input::request('v');
		if ($m == "user" && $v == "login")
		{
			
		}
		else
		{
			$this->checkUser(); //检查登录
		}
		$this->template("$m/$v");
	}

	public function menu()
	{
		$m = Loader::model("menu");
		$menu = $m->listMenu();
		$sub_menu = $m->listMenuItem();
		$scope_ids = Loader::model("user")->getUserScopeIds();

		$this->template("tpl/menu", [
			"menu" => $menu,
			"sub_menu" => $sub_menu,
			"scope_ids" => $scope_ids
		]);
	}

	public function goBack($offset = -1)
	{
		$this->exitJs("history.go($offset)");
	}

	public function exitJs($js)
	{
		echo '<script>' . $js . '</script>';
		exit;
	}

}
