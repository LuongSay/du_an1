<?php
session_start();
require_once './commoms/utils.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<?php 
	if(isset($_GET['msg1']) && $_GET['msg1'] != ""){
		?>
		<div class="alert alert-primary" role="alert">
			<?= $_GET['msg1'] ?>
		</div>
	<?php } 
	?>
	<div class="container" style="margin-top: 5%;margin-left: 40%">
		<div class="col-lg-4 text-center">
			<a href="http://localhost/Leaning-PHP/du_an1/post-login.php"><img src="http://localhost/Leaning-PHP/du_an1/public/img/logo.png"></a>
			<h4 class="pt-4" style="font-weight: bold">ĐĂNG KÍ</h4>
			<!-- /.login-logo -->
			<form action="submit_registered.php" method="post" id="form">
				<div class="col-lg-12 pt-3">
					<div class="form-group">
						<?php 
						if(isset($_GET['msg2']) && $_GET['msg2'] != ""){
							?>
							<span class="text-danger"> | <?= $_GET['msg2'] ?></span>
						<?php } 
						?>
						<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">

						<input type="text" name="fullname" class="form-control" placeholder="Tên đầy đủ">
					</div>
					<div class="form-group">

						<input type="text" name="sdt" class="form-control" placeholder="Số điện thoại">
					</div>
					<div class="form-group">

						<input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu">
					</div>
					<!-- /.error -->
					<div class="form-group">

						<input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu">
					</div>
					<div class="text-right">
						<a href="login.php" class="btn btn-primary">Đăng nhập</a>
						<button type="submit" class="btn btn-success">Đăng kí </button>
					</div>
				</div>
			</form>	
		</div>
	</div>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
		$().ready(function() {
			$("#form").validate({
				onfocusout: false,
				onkeyup: false,
				onclick: false,
				rules: {
					"email": {
						required: true,
						email:true,

					},

					"fullname":{
						required: true,
						minlength:2,
					},
					"sdt": {
						required: true,
						minlength:10,
						maxlength:11,

					},

					"password":{
						required: true,
						minlength:6,
					},
					"confirm_password":{
						required: true,
						minlength:6,
						equalTo: "#password",
					},
				},
				messages: {
					"email": {
						required: "<p class='mb-0' style='color: red;'>Bạn cần nhập email!!!</p>",
						email: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng email!!!</p>",
					},


					"fullname":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng điền tên</p>",
						minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 2 kí tự</p>",
					},
					"sdt": {
						required: "<p class='mb-0' style='color: red;'>Vui lòng nhập số điện thoại</p>",
						minlength:"<p class='mb-0' style='color: red;'>Độ dài từ 10 đến 11 kí tự</p>",
						maxlength:"<p class='mb-0' style='color: red;'>Độ dài từ 10 đến 11 kí tự</p>",

					},

					"password":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng nhập mật khẩu</p>",
						minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 6 kí tự</p>",
					},
					"confirm_password":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng nhập đầy đủ</p>",
						minlength: "<p class='mb-0' style='color: red;'>Độ dài ít nhất 6 kí tự</p>",
						equalTo:"<p class='mb-0' style='color: red;'>Mật khẩu không khớp</p>",
					},
				}
			});
		});
	</script>
</body>
</html>