<?php 
	Loader::view('tpl/header');
	Loader::view('tpl/menu');
?>
<div class="page-tab" id="pageTab">
	<?php
	$db_stmt = Db::table("module")
			->field(
					"id as 'ID'", "name as '模块名'", "url_template as 'URL'", "icon_tag as '图标类'", "concat('<i class=\"glyphicon glyphicon-',icon_tag,'\"/>') as '图标'", "parent_id as '父ID'", "create_time as '创建时间','__H__' as '操作'"
			)
			->page(Input::request("page_no", 1, "intval"), 10);
	echo (new VIew)->setTag("table")->setId("tableId")->setClass("table table-bordered table-condensed")->bindDbStmt($db_stmt)->getBody(function($row, &$tr) {
		$ajax_url = "/api/module/delete/id:" . $row['ID'];
		$td = (new View)->setTag("td")->append(
						(new View)->setTag("a")->setClass("btn btn-primary btn-sm")->attr("href", "/m:web/v:module-edit/id:" . $row['ID'])->setBody("修改")
				)
				->append(
				(new View)->setTag("a")->setClass("btn btn-danger btn-sm")->attr("href", "/m:web/v:common-confirm/title:删除/content:是否确定删除/ajax_url:" . urlencode($ajax_url))->setBody("删除")
		);
		$tr->append($td);
	})->html();

	echo (new VIew)->setTag("nav")->setId("navId")->setClass("pagination pagination-sm")->bindDbStmt($db_stmt)->setBaseUrl("http://bsep.viky.studio/api/web/user-list/")->getBody()->html();
	?>
</div>
	<?php Loader::view('tpl/footer.php'); ?>
