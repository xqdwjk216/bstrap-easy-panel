<?php Loader::view('tpl/header'); ?>
<?php
(new WebApi)->menu();
?>
<div class="page-tab" id="pageTab">
	<?php
	$db_stmt = Db::table("user")
			->field(
					"id as 'ID'", "name as '姓名'", "roles as 角色", "create_time as '创建时间'", "modify_time as '修改时间'", "'__H__' as '操作'"
			)
			->page(Input::request("page_no", 1, "intval"), 10);

	echo (new VIew)->setTag("table")->setId("tableId")->setClass("table table-condensed")->bindDbStmt($db_stmt)->getBody(function($row, &$tr) {
		$ajax_url = "/api/user/delete/id:" . $row['ID'];
		$td = (new View)->setTag("td")->append(
						(new View)->setTag("a")->setClass("btn btn-primary btn-sm")->attr("href", "/web/m:user/v:user-edit/id:" . $row['ID'])->setBody("修改")
				)
				->append(
				(new View)->setTag("a")->setClass("btn btn-danger btn-sm")->attr("href", "/web/m:common/v:confirm/title:删除/content:是否确定删除/ajax_url:" . urlencode($ajax_url))->setBody("删除")
		);
		$tr->append($td);
	})->html();

	echo (new View)->setTag("nav")->setId("navId")->setClass("pagination pagination-sm")->bindDbStmt($db_stmt)->setBaseUrl("/web/m:user/v:user-list/")->getBody()->html();
	?>
</div>
<?php Loader::view('tpl/footer.php'); ?>
