<?php

ini_set('date.timezone', 'Asia/Shanghai');
date_default_timezone_set("PRC");
define("ENV", "dev");
define("DS", DIRECTORY_SEPARATOR);
define("APP_PATH", __DIR__ . DS);
define("CORE_PATH", APP_PATH . "core" . DS);
define("CONF_PATH", APP_PATH . "conf" . DS);
define("MODEL_PATH", APP_PATH . "model" . DS);
define("MODEL_FILE_PREFIX","model_");
define("VIEW_PATH", APP_PATH . "web" . DS);
define("CONTROLLER_PATH", APP_PATH . "controller" . DS);
define("MODULE", "index");
header('Content-Type: text/html; charset=utf-8');
ini_set("opcache.enable", 0);

register_shutdown_function('handleError');
function handleError()
{
	$last_error = error_get_last();
	if ($last_error['message'] != '')
	{
		echo implode("|",array(__LINE__, $last_error['message'], __METHOD__, $last_error['file'], $last_error['line']));
		ob_start();
		debug_print_backtrace();
		$trace = ob_get_contents();
		ob_end_clean();
		echo implode("|",array(__LINE__, "trace->" . $trace, __METHOD__, $last_error['file'], $last_error['line']));
	}
}

require CORE_PATH ."common.php";
require CORE_PATH ."loader.php";
require CONF_PATH."config.php";
require CONF_PATH ."load.php";
if( !defined("IS_WEB") ){
	require CONF_PATH ."route.php";
}