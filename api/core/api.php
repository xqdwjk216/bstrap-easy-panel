<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api
 *
 * @author hll
 */
class Api {

    const ErrCode404 = 404;
    const ErrCode1001 = 1001;
    const ErrCode1002 = 1002;

    var $errMsgMap = [
        404 => 'Not Found',
        1001 => 'Param Error',
        1002 => 'Error Email Or Password'
    ];

    function __construct() {
        
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

    public function display() {
        if (isset($_SERVER['REQUEST_URI'])) {
            $apiName = preg_replace("/[?&#].+/", "", basename($_SERVER['REQUEST_URI']));
        } else if (class_exists("PhpTrace")) {
            $trace = PhpTrace::getTraceTop();
            list( $apiName, $tmp) = explode(".", basename($trace->getTraceFile()));
        }

        Loader::api($apiName);
        $className = ucfirst($apiName) . "Api";

        if (class_exists($className)) {
            $obj = new $className;
            if (method_exists($obj, "index")) {
                echo $obj->index();
            } else {
                $this->errExit(Api::ErrCode404);
            }
        } else {
            $this->errExit(Api::ErrCode404);
        }
    }

}
