<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BenchMark {

    static $ts_start;
    static $ts_start_micro;
    static $ts_end;
    static $ts_end_micro;

    public static function markStart() {
        self::$ts_start = time();
        self::$ts_start_micro = microtime(true);
    }

    public static function markEnd() {
        self::$ts_end = time();
        self::$ts_end_micro = microtime(true);
    }

    public static function display() {
        
    }

    public static function getCostMs() {
        if (self::$ts_start_micro <= 0 || self::$ts_end_micro <= 0) {
            throw new Exception("no start or end tag found");
        }
        return round((self::$ts_end_micro - self::$ts_start_micro) * 1000, 3);
    }

}
