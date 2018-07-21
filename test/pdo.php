<?php
    
    require "../index.php";
    $version = Db::init()->fetchCol("select version()");
    Log::info(sprintf("version:[%s]",$version));