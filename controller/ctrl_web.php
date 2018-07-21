<?php
    
    class ctrlWeb extends Api{
        function index(){
            $view_set = Input::request("v","index","trim");
            $parts = explode("-", $view_set);
            $view_path = array_shift($parts);
            $view_name =implode("-", $parts);
            Loader::view("$view_path/$view_name");
        }
    }