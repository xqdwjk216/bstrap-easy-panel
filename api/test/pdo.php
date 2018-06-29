<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once "../core/dbstmt.php";
include_once "../core/phptrace.php";
include_once "../core/config.php";
Config::init();
include_once "../core/log.php";
Log::init();
include_once "../core/db.php";
Db::init();

$res = Db::table("user")->cond("email")->field("email,id")->bindStr("email", "gavin.wen@gmail.com")->exec()->fetchCol();
var_dump($res);

$res = Db::table("user")->cond("id")->field("name,id,email")->bindInt("id", 1)->exec()->fetchAllAssoc("name");
var_dump($res);
