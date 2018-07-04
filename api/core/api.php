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
include_once "loader.php";
include_once "dbstmt.php";
include_once "phptrace.php";
include_once "config.php";
Config::init();
include_once "log.php";
Log::init();
include_once "db.php";
Db::init();
include_once "input.php";

class Api {

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

    function __construct() {
        $this->getUser();
    }

    function succExit($data = "") {
        $retArr = [
            "errCode" => 0,
            "errMsg" => "",
            "data" => $data ? $data : new stdClass()
        ];
        echo json_encode($retArr, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function errExit($errCode, $errMsg = "") {
        $retArr = [
            "errCode" => $errCode,
            "errMsg" => isset($this->errMsgMap[$errCode]) ? $this->errMsgMap[$errCode] : ""
        ];
        if ($errMsg) {
            $retArr['errMsg'] .= "[" . $errMsg . "]";
        }
        echo json_encode($retArr, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function getUser(){
        $m = Loader::model("user");
        $user = $m->getCurrentUser();
        if( !$user ){
            $this->errExit(Api::ErrCode1003);
        }
        return $user;
    }

    public function display() {
        $parts = explode("/", trim($_SERVER['REQUEST_URI']));
        $apiName = str_replace(".php", "", $parts[2]);
        Loader::api($apiName);

        $className = ucfirst($apiName) . "Api";
        $methodName = "index";

        if (count($parts) > 3) {
            $methodName = preg_replace("/[?#].*/","",$parts[3]);
            $param = array();
            for ($i = 3; $i < count($parts) - 1; $i++) {
                list($key,$val) = explode(":",$parts[$i + 1]);
                $param[trim($key)] = trim($val);
            }
            $_GET = array_merge($_GET, $param);
            $_POST = array_merge($_POST, $param);
            $_REQUEST = array_merge($_REQUEST, $param);
        }

        if (class_exists($className)) {
            $obj = new $className;
            if (method_exists($obj, $methodName)) {
                echo $obj->$methodName();
            } else {
                $this->errExit(Api::ErrCode404);
            }
        } else {
            $this->errExit(Api::ErrCode404);
        }
    }

    public function template($view_name, $data = [], $return = FALSE) {
        $dir = __DIR__;
        $view_file = $dir . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . $view_name . ".php";

        if (!file_exists($view_file)) {
            if (!$return) {
                Header("HTTP/1.1 404 Not Found");
                return "";
            } else {
                return "123123";
            }
        }

        foreach ($data as $key => $val) {
            ${$key} = $val;
        }

        if ($return) {
            ob_start();
            include($view_file);
            $html = ob_get_contents();
            ob_clean();
            return $html;
        } else {
            include($view_file);
        }
    }

}
