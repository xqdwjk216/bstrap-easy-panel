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
  		<table class="table table-bordered table-condensed">
    <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
        </tbody>
  </table>

  <nav aria-label="...">
        <ul class="pagination pagination-sm">
          <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
        </ul>
      </nav>
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
