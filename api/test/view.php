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

include_once "../core/loader.php";

Loader::core("view");
Loader::core("input");

Loader::view("header");

$db_stmt = Db::table("user")
		->field(
				"id as 'ID'", "name as '姓名'", "pwd as '密码'", "create_time as '创建时间'"
		)
		->page(Input::request("page_no", 1, "intval"), 10);
echo (new VIew)->setTag("table")->setId("tableId")->setClass("table table-bordered table-condensed")->bindDbStmt($db_stmt)->getBody()->html();

echo (new VIew)->setTag("nav")->setId("navId")->setClass("pagination pagination-sm")->bindDbStmt($db_stmt)->setBaseUrl("http://bsep.viky.studio/api/test/view.php/")->getBody()->html();

Loader::view("footer");
