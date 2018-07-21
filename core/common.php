<?php
    if( !function_exists("is_post") ){
        function is_post()
        {
            return !empty($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
        }
    }

    if( !function_exists("is_ajax") ){
        function is_ajax()
        {
            return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST';
        }
    }

    if( !function_exists("is_prd") ){
        function is_prd()
        {
            return defined("ENV") && ENV == 'prd';
        }
    }

    if( !function_exists("to_big_hump") ){
        function to_big_hump($str)
        {
            $parts = preg_split("/[-_.]/", $str);
            $str_hump = "";
            foreach ($parts as $value) {
                $str_hump .= ucfirst($value);
            }

            return $str_hump;
        }
    }

    if( !function_exists("to_lit_hump") ){
        function to_lit_hump($str)
        {
            $parts = preg_split("/[-_.]/", $str);
            $str_hump = $parts[0];
            $len = count($parts);
            for( $i=1;$i<$len;$i++){
                $str_hump .= ucfirst($parts[$i]);
            }
            return $str_hump;
        }
    }

    if( !function_exists("to_lit_hump") ){
        function to_lit_hump($str)
        {
            $parts = preg_split("/[-_.]/", $str);
            $str_hump = $parts[0];
            $len = count($parts);
            for( $i=1;$i<$len;$i++){
                $str_hump .= ucfirst($parts[$len]);
            }
            return $str_hump;
        }
    }
