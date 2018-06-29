<?php include 'header.php'; ?>
<div class="page-tab" id="pageTab">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#table" aria-controls="table" role="tab" data-toggle="tab">Table</a></li>
    <li role="presentation"><a href="#modal" aria-controls="modal" role="tab" data-toggle="tab">Modal</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="table">
		<?php include 'table.php'; ?>
	</div>
    <div role="tabpanel" class="tab-pane" id="modal">
		<?php include 'modal.php'; ?>
	</div>
    <div role="tabpanel" class="tab-pane" id="messages">
		<?php include 'table.php'; ?>
	</div>
    <div role="tabpanel" class="tab-pane" id="settings">
		<?php include 'table.php'; ?>
	</div>
  </div>
</div>
<?php include 'footer.php'; ?>
