<?php Loader::view('tpl/header'); ?>
<?php
(new WebApi)->menu();
?>
<div class="page-tab" id="pageTab">
	<div class="alert alert-warning alert-dismissible fade in" style="display:none" role="alert" id="pageAlert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<span class="body"></span>
    </div>
	<form class="page-form-uer-edit" id="pageFormUserEdit">
		<?php
		$user = DB::table("user")->cond("id")->field(
						"name as '姓名'", "email as '邮箱'", "pwd as '密码'", "scope_ids as '权限'", "roles as '角色'", "id")->bindInt("id", Input::get("id", 0, "intval"))->exec()->fetch();
		$fields = ['姓名', '邮箱', '密码', '权限', '角色', 'id'];
		$en_fields = ['name', 'email', 'pwd', 'scope_ids', 'roles', 'id'];
		foreach ($fields as $idx => $field)
		{
			$input = (new View)->setTag("input")->setId("exampleInput" . $field)->setClass("form-control")->attr("name", $en_fields[$idx])->attr("value", $user[$field]);
			$fg = (new View)->setTag("div")->setClass("form-group");
			if ($en_fields[$idx] == 'id')
			{
				$fg->setStyle("display:none");
			}
			elseif ($en_fields[$idx] == 'pwd')
			{
				$input->attr("type", "password");
			}
			$fg->append(
					(new View)->setTag("label")->attr("for", "exampleInput" . $field)->setBody($field)
			)->append($input);
			echo $fg->html();
		}
		echo $fg->html();
		?>
		<button type="submit" class="btn btn-default" >Submit</button>
	</form>
</div>
<?php Loader::view('tpl/footer'); ?>
<script>
	$(function () {
		$("#pageFormUserEdit").submit(function (e) {
			e.preventDefault();
			e.stopPropagation();
			$.getJSON('/api/user/save', $(this).serialize(), function (rsp) {
				$("#pageAlert .body").text(rsp.errMsg || "未修改");
				$("#pageAlert").show();
				if (rsp.data.rowCount) {
					$("#pageAlert").hide();
					history.go(-1);
				}
			});
			return false;
		})
	})
</script>
</body>
</html>