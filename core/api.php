<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api
 *
 * @author gavin
 */
class Api
{

	const ErrCode404 = 404;
	const ErrCode1001 = 1001;
	const ErrCode1002 = 1002;
	const ErrCode1003 = 1003;

	var $errMsgMap = [
		404 => 'Not Found',
		1001 => 'Param Error',
		1002 => 'Error Email Or Password',
		1003 => 'Login Required',
	];

	function __construct()
	{
		
	}

	function succExit($data = "")
	{
		$retArr = [
			"errCode" => 0,
			"errMsg" => "",
			"data" => $data ? $data : new stdClass()
		];
		echo json_encode($retArr, JSON_UNESCAPED_UNICODE);
		exit;
	}

	function errExit($errCode, $errMsg = "")
	{
		$retArr = [
			"errCode" => $errCode,
			"errMsg" => isset($this->errMsgMap[$errCode]) ? $this->errMsgMap[$errCode] : ""
		];
		if ($errMsg)
		{
			$retArr['errMsg'] .= "[" . $errMsg . "]";
		}
		echo json_encode($retArr, JSON_UNESCAPED_UNICODE);
		exit;
	}

	public function checkUser()
	{
		$user = $this->getUser();
		if (!$user)
		{
			if (isAjax())
			{
				$this->errExit(Api::ErrCode1003);
			}
			else
			{
				header("Location:/web/m:user/v:login");
			}
		}
	}

	public function getUser()
	{
		$m = Loader::model("user");
		$user = $m->getCurrentUser();
		return $user;
	}

	public function template($view_name, $data = [], $return = FALSE)
	{
		$view_file = VIEW_PATH . $view_name . ".php";
		if (!file_exists($view_file))
		{
			$view_file = VIEW_PATH . "tpl/404.php";
		}

		foreach ($data as $key => $val)
		{
			${$key} = $val;
		}

		if ($return)
		{
			ob_start();
			include($view_file);
			$html = ob_get_contents();
			ob_clean();
			return $html;
		}
		else
		{
			include($view_file);
		}
	}

}
