<?php
include_once "../inc.php";
Loader::core("api");
Loader::core("dbstmt");
Loader::core("phptrace");
Loader::core("config")->init();
Loader::core("log")->init();
Loader::core("db")->init();
Loader::core("input");
Loader::core("view");
Loader::model("base");
Loader::api("web");
?>

<?php Loader::view('tpl/header', ['page_title' => 'Test Page']); ?>
<?php
(new WebApi)->menu();
?>
<div class="page-tab" id="pageTab">
	<?php
	$db_stmt = Db::table("test_page")
			->field(
					"name as '模块名'", "url_template as 'URL'", "create_time as '创建时间','__H__' as '操作'"
			)
			->page(Input::request("page_no", 1, "intval"), 10);
	echo (new VIew)->setTag("table")->setId("tableId")->setClass("table table-condensed")->bindDbStmt($db_stmt)->getBody(function($row, &$tr) {
		$td = (new View)->setTag("td")->append(
				(new View)->setTag("a")->setClass("btn btn-primary btn-sm")->attr("target", "_blank")->attr("href", $row['URL'])->setBody("查看")
		);
		$tr->append($td);
	})->html();

	echo (new VIew)->setTag("nav")->setId("navId")->setClass("pagination pagination-sm")->bindDbStmt($db_stmt)->setBaseUrl("http://bsep.viky.studio/api/web/user-list/")->getBody()->html();
	?>
</div>
<?php Loader::view('tpl/footer.php'); ?>
</body>
</html>