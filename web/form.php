<?php include 'header.php'; ?>
<form class="page-form-login" id="pageFormLogin">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile">
        <p class="help-block">Example block-level help text here.</p>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Check me out
        </label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php include 'footer.php'; ?>
<script>
    $(function () {
        $("#pageFormLogin").submit(function (e) {
            e.preventDefault();
            e.stopPropagation();
           	$.getJSON('/api/login',$(this).serialize(),function(rsp){
				location.href = "/web/index.html";
			});
            return false;
        })
    })
</script>
