<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Loader
{

	public static function model($filename)
	{
		self::load(MODEL_PATH . "model_".$filename . ".php");
		$className = "model".ucfirst($filename);
		return new $className;
	}

	public static function core($filename)
	{
		self::load(CORE_PATH . $filename . ".php");
		$className = ucfirst($filename);
		return new $className;
	}

	public static function api($filename)
	{
		self::load(API_PATH . $filename . ".php");
		$className = ucfirst($filename) . "Api";
		return new $className;
	}

	public static function view($filename, $data = [])
	{
		self::load(VIEW_PATH . str_replace("/", DIRECTORY_SEPARATOR, $filename) . ".php", $data);
	}

	public static function load($file, $data = [])
	{
		if (file_exists($file))
		{
			foreach ($data as $key => $val)
			{
				${$key} = $val;
			}
			include_once $file;
		}
	}

}
