<?php
    //////////////参数解析 /k:v
    $uri = preg_replace("/[?#].+/", "", trim($_SERVER['REQUEST_URI']));
    if (!empty($_GET))
    {
        $first_k = array_keys($_GET)[0];
        $first_v = $_GET[$first_k];
        $_GET[preg_replace("/.+?[?#]/", "", $first_k)] = $first_v;
        unset($_GET[$first_k]);
    }

    $parts = explode("/", $uri);
    $param = array();
    foreach( $parts as $pt ){
        $param_parts = explode(":", $pt);
        if (count($param_parts) == 2)
        {
            $param[$param_parts[0]] = urldecode($param_parts[1]);
        }
    }

    if( !empty($param) ){
        $_GET = array_merge($_GET, $param);
        $_POST = array_merge($_POST, $param);
        $_REQUEST = array_merge($_REQUEST, $param);
    }


    //////////////
    $_m = Input::get("m","web","trim|strtolower");
    $_a = Input::get("a","index","trim|strtolower");

    $controller_file = CONTROLLER_PATH."ctrl_".$_m.".php";
    if( file_exists($controller_file) ){
        include $controller_file;
        $class_name = "ctrl".to_big_hump($_m);
        $ctrl = new $class_name;
        if( method_exists($ctrl, $_a) ){
            call_user_func_array([$ctrl,$_a],[]);
            return;
        }else{
            throw new Exception("Method not found ".$class_name." ".$_a, __LINE__); 
        }
    }

    if( !is_prd() ){
        throw new Exception("Invalid controller", __LINE__); 
    }
