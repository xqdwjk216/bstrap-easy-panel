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

	function isAjax()
	{
		return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST';
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
			if ($this->isAjax())
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

	/**
	 * 路由控制
	 * @return [type] [description]
	 */
	public function display()
	{
		$uri = preg_replace("/[?#].+/", "", trim($_SERVER['REQUEST_URI']));
		if (!empty($_GET))
		{
			$first_k = array_keys($_GET)[0];
			$first_v = $_GET[$first_k];
			$_GET[preg_replace("/.+?[?#]/", "", $first_k)] = $first_v;
			unset($_GET[$first_k]);
		}

		if (strpos($uri, "/web") === 0)
		{
			$uri = "/api" . $uri;
		}


		$parts = explode("/", $uri);
		$api_name = isset($parts[2]) ? $parts[2] : "";
		$api_name = str_replace(".php", "", $api_name);
		Loader::api($api_name);

		$class_name = ucfirst($api_name) . "Api";
		$method_name = "index";

		if (isset($parts[3]))
		{
			if (strpos($parts[3], ":") === false)
			{
				$method_name = $parts[3];
			}
			else
			{
				$len = count($parts);
				$param = array();
				for ($i = 3; $i < $len; $i++)
				{
					$param_parts = explode(":", $parts[$i]);
					if (count($param_parts) == 2)
					{
						$param[$param_parts[0]] = urldecode($param_parts[1]);
					}
				}
				$_GET = array_merge($_GET, $param);
				$_POST = array_merge($_POST, $param);
				$_REQUEST = array_merge($_REQUEST, $param);
			}
		}

		$method_parts = explode("-", $method_name);
		$method_name = $method_parts[0];
		$len = count($method_parts);
		for ($i = 1; $i < $len; $i++)
		{
			$method_name .= ucfirst($method_parts[$i]);
		}

		if (class_exists($class_name))
		{
			$obj = new $class_name;
			if (method_exists($obj, $method_name))
			{
				echo $obj->$method_name();
			}
			else if (method_exists($obj, "index"))
			{
				echo $obj->index();
			}
			else
			{
				$this->errExit(Api::ErrCode404);
			}
		}
		else
		{
			$this->errExit(Api::ErrCode404);
		}
	}

	public function template($view_name, $data = [], $return = FALSE)
	{
		$view_file = WEB_PATH . $view_name . ".php";
		if (!file_exists($view_file))
		{
			$view_file = WEB_PATH . "tpl/404.php";
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
