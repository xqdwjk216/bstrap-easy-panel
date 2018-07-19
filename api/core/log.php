<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Log {

    static $log_instance;
    static $level = "INFO";
    static $time;
    static $module;
    static $line = 0;
    static $seperator = "|";

    public static function init() {
        if (Log::$log_instance) {
            return Log::$log_instance;
        }
        if (!file_exists(dirname(Config::getLogPath()))) {
            throw new Exception(sprintf("path_config file not exists:[%s]", Config::getLogPath()));
        }
    }

    public static function getNowTime() {
        return date("Y-m-d H:i:s");
    }

    public static function info($msg) {
        self::$time = self::getNowTime();
        self::$level = "INFO";
        self::flush($msg);
    }

    public static function debug($msg) {
        self::$time = self::getNowTime();
        self::$level = "DEBUG";
        self::flush($msg);
    }

    public static function error($msg) {
        self::$time = self::getNowTime();
        self::$level = "ERROR";
        self::flush($msg);
    }

    public static function flush($msg) {
        $trace = PhpTrace::getTraceByIndent(-3, __FILE__, __LINE__);    //获取上一层调用信息
        self::$module = $trace->getTraceFile();
        self::$line = $trace->getTraceFileLine();
        $data = [
            self::$time,
            self::$level,
            self::$module,
            self::$line,
            $msg
        ];
        file_put_contents(Config::getLogPath() . "." . date("Ymd") . ".log", implode(self::$seperator, $data) . "\n");
    }

}
