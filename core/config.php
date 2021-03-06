<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

date_default_timezone_set('PRC');

class Config
{

	/**
	 * log_path
	 */
	static $log_path = "";
	static $auto_addslashes = true;
	static $auto_trim = true;
	static $pwd_md5_salt = "sldfjsdf";

	public static function getPwdMd5Salt()
	{
		return self::$pwd_md5_salt;
	}

	public static function init()
	{
		if (get_magic_quotes_gpc())
		{
			self::$auto_addslashes = false;
		}
	}

	public static function getAutoAddslashes()
	{
		return self::$auto_addslashes;
	}

	public static function getAutoTrim()
	{
		return self::$auto_trim;
	}

	public static function getLogPath()
	{
		return self::$log_path;
	}

	/**
	 * mysql config
	 */
	static $mysql_host = "";
	static $mysql_port = 3306;
	static $mysql_user = "root";
	static $mysql_password = "";
	static $mysql_db_name = "";
	//是否使用长连接
	static $pdo_attr_persistent = false;

	/**
	 * 返回pdo mysql的各项配置信息
	 */
	public static function getPdoMysqlDsn()
	{
		$dsn = sprintf("mysql:host=%s:%s;dbname=%s", self::$mysql_host, self::$mysql_port, self::$mysql_db_name);
		return $dsn;
	}

	public static function getPdoMysqlUser()
	{
		return self::$mysql_user;
	}

	public static function getPdoMysqlPassword()
	{
		return self::$mysql_password;
	}

}
