<?php Loader::view('tpl/header'); ?>
<div class="page-tab" id="pageTab">
	<div class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?php echo Input::request("title", "Modal title", "htmlspecialchars"); ?></h4>
				</div>
				<div class="modal-body">
					<p><?php echo Input::request("content", "Modal content", "htmlspecialchars"); ?></p>
					<p id="result" style="color:red"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="history.go(-1)">返回</button>
					<button type="button" class="btn btn-primary" onclick="onSure()">确定</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
		setTimeout(function () {
			$(".modal").modal("show");
		}, 0);
		function onSure() {
			var ajax_url = '<?php echo Input::request("ajax_url", "", "urldecode"); ?>';
			$.getJSON(ajax_url, function (rsp) {
				$("#result").text();
				if (rsp.errCode == 0) {
					history.go(-1);
				} else {
					$("#result").text(rsp.errMsg || "操作失败").show();
				}
			})
		}
	</script>
</div>
<?php Loader::view('tpl/footer'); ?>