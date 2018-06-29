<?php include 'header.php'; ?>
<div class="panel-group page-menu" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <div class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </a>
      </div>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       	<h6><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Link</a></h6>
       	<h6><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Link</a></h6>
       	<h6><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  Link</a></h6>
       	<h6><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>  Link</a></h6>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <div class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </div>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
		item2
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <div class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </a>
      </div>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
		item3
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
