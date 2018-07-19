<?php

ini_set('date.timezone', 'Asia/Shanghai');
date_default_timezone_set("PRC");
define("ENV", "dev");
define("DEPLOY_TAG", basename(__DIR__));
define("APP_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("API_PATH", __DIR__ . DIRECTORY_SEPARATOR . "api" . DIRECTORY_SEPARATOR);
define("CORE_PATH", API_PATH . "core" . DIRECTORY_SEPARATOR);
define("MODEL_PATH", API_PATH . "model" . DIRECTORY_SEPARATOR);
define("WEB_PATH", APP_PATH . "web" . DIRECTORY_SEPARATOR);
define("MODULE", "index");
define("LOG_PATH", "/data/wwwlogs/" . DEPLOY_TAG . "/" . MODULE . (ENV ? "-" . ENV : "") . date(".Ymd") . ".log");
header('Content-Type: text/html; charset=utf-8');
ini_set("opcache.enable", 0);
$start_ts = microtime(true);
session_start();

include_once CORE_PATH . "loader.php";

function isPost()
{
	return !empty($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}

if (!file_exists(LOG_PATH))
{
	touch(LOG_PATH);
}

function writeLog($level, $err_msg, $module = NULL, $file_path = NULL, $line_num = NULL)
{
	$level = strtolower($level);
	$log_arr = [
		$err_msg ? preg_replace("/\s+/", " ", $err_msg) : NULL,
		$file_path ? preg_replace("/\s+/", " ", $file_path) : NULL,
		$line_num ? $line_num : NULL
	];
	file_put_contents(LOG_PATH, date("H:i:s") . " " . implode(" ", $log_arr) . "\n", FILE_APPEND);
}

function infoLog($err_msg, $module = NULL, $file_path = NULL, $line_num = NULL)
{
	writeLog("info", $err_msg, $module, $file_path, $line_num);
}

function debugLog($err_msg, $module = NULL, $file_path = NULL, $line_num = NULL)
{
	writeLog("debug", $err_msg, $module, $file_path, $line_num);
}

function errorLog($err_msg, $module = NULL, $file_path = NULL, $line_num = NULL)
{
	writeLog("error", $err_msg, $module, $file_path, $line_num);
}

register_shutdown_function('handleError');

function handleError()
{
	$last_error = error_get_last();
	if ($last_error['message'] != '')
	{
		errorLog(__LINE__, $last_error['message'], __METHOD__, $last_error['file'], $last_error['line']);
		ob_start();
		debug_print_backtrace();
		$trace = ob_get_contents();
		ob_end_clean();
		errorLog(__LINE__, "trace->" . $trace, __METHOD__, $last_error['file'], $last_error['line']);
	}
}

$end_ts = microtime(true);
if (!empty($_POST))
{
	writeLog("access", intval(($end_ts - $start_ts) * 1000) . " " . $_SERVER['REQUEST_URI'] . "&" . urldecode(http_build_query($_POST)));
}
else
{
	writeLog("access", intval(($end_ts - $start_ts) * 1000) . " " . $_SERVER['REQUEST_URI']);
}
