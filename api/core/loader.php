<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Loader {

    public static function model($filename) {
        $file = dirname(__FILE__) . "".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."model".DIRECTORY_SEPARATOR."" . $filename . "_model.php";

        self::load($file);
        $className = ucfirst($filename)."Model";
        return new $className;
    }

    public static function core($filename) {
        self::load(dirname(__FILE__) . "".DIRECTORY_SEPARATOR."" . $filename . ".php");
    }

    public static function api($filename) {
        self::load(dirname(__FILE__) . "".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."" . $filename . ".php");
    }

    public static function view($filename) {
        $file = dirname(__FILE__) . "".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR."" . $filename . ".php";
        self::load($file);
    }

    public static function load($file) {
        if (file_exists($file)) {
            include_once $file;
        }
    }

}
