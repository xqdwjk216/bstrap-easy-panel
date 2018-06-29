<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Loader {

    public static function model($filename) {
        self::load(dirname(__FILE__) . "/../model/" . $filename . ".php");
        $className = "Model_" . ucfirst($filename);
        return new $className;
    }

    public static function core($filename) {
        self::load(dirname(__FILE__) . "/" . $filename . ".php");
    }

    public static function api($filename) {
        self::load(dirname(__FILE__) . "/../" . $filename . ".php");
    }

    public static function load($file) {
        if (file_exists($file)) {
            include_once $file;
        }
    }

}
