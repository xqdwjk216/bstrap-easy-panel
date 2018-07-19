<div class="panel-group page-menu" id="accordion" role="tablist" aria-multiselectable="true">
	<?php
	if (!isset($menu))
	{
		$menu = Loader::model("menu")->listMenu();
		$sub_menu = Loader::model("menu")->listMenuItem();
		$scope_ids = Loader::model("user")->getUserScopeIds();
	}
	foreach ($menu as $id => $item)
	{
		if (!in_array($id, $scope_ids))
		{
			continue;
		}
		?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<div class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<?php echo $item['name']; ?>
					</a>
				</div>
			</div>
			<?php
			if (isset($sub_menu[$id]))
			{
				?>
				<?php
				foreach ($sub_menu[$id] as $sub_item)
				{
					if (!in_array($sub_item['id'], $scope_ids))
					{
						continue;
					}
					?>
					<div id="collapse<?php echo $sub_item['id']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<h6><a href="<?php echo $sub_item['url_template']; ?>" class="btn btn-default" role="button"><span class="glyphicon glyphicon-<?php echo $sub_item['icon_tag']; ?>" aria-hidden="true"></span>  <?php echo isset($sub_item['name']) ? $sub_item['name'] : ""; ?></a></h6>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>
</div>
