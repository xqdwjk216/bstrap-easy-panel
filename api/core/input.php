<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Input {

    public static function get($key, $default = "", $filter = "") {
        $val = isset($_GET[$key]) ? $_GET[$key] : $default;
        return self::filter($val, $filter);
    }

    public static function post($key, $default = "", $filter = "") {
        $val = isset($_POST[$key]) ? $_POST[$key] : $default;
        return self::filter($val, $filter);
    }

    public static function cookie($key, $default = "", $filter = "") {
        $val = isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
        return self::filter($val, $filter);
    }

    public static function request($key, $default = "", $filter = "") {
        $val = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
        return self::filter($val, $filter);
    }

    public static function filter($input, $func) {
        $func = trim($func);
		$filter = "";
        if (Config::getAutoTrim()) {
            $filter .= "|trim";
        }
        $funcs = explode("|", $func);
        $funcs = array_unique($funcs);
        foreach ($funcs as $func) {
            $func = trim($func);
            if (!$func) {
                continue;
            }
            if (is_array($input)) {
                foreach ($input as &$v) {
                    $v = $func($v);
                }
            } else {
                $val = $func($val);
            }
        }
        return $input;
    }

}
