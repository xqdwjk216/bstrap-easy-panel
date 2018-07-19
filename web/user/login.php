<?php Loader::view('tpl/header'); ?>
<style>
	.page-form-login{
		width: 500px;
		margin:0 auto;
		margin-top: 80px;
	}
</style>
<form class="page-form-login" id="pageFormLogin">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="xqdwjk216@gmail.com" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="123123" placeholder="Password">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox"> Remember Me
        </label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php Loader::view('tpl/footer'); ?>
<script>
	$(function () {
		$("#pageFormLogin").submit(function (e) {
			e.preventDefault();
			e.stopPropagation();
			$.getJSON('/api/user/login', $(this).serialize(), function (rsp) {
				location.href = "/web";
			});
			return false;
		})
	})
</script>
</body>
</html>