<?php 
session_start(); 
require_once './commoms/utils.php';
$web_settings = "SELECT * FROM web_settings";
$stmt = $conn->prepare($web_settings);
$stmt->execute();
$web_settings = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Liên hệ với chúng tôi</title>
	<?php include './share/client_asset.php'; ?>
	<style type="text/css">
	.all{
		font-family: inherit;
		color: #434343;
		
	}
</style>
</head>
<body>
	<?php require './share/header.php'; ?>
	<div class="container-fluid all">
		<div class="container">
			<h2 class="pt-5" style="font-weight: 500">Liên hệ với chúng tôi</h2>
			<h4 class="pt-2">Địa chỉ của chúng tôi</h4>
			<div class="col-md-12 rounded" style="border: 1px solid grey">
				<div class="row p-4">
					<div class="col-md-4">
						<p class="font-weight-bold" style="font-weight: 700">Nguyễn Đại Lượng</p>
						<p class="font-weight-light" style="font-size: 14px"><?= $web_settings['adress'] ?></p>
						<button type="button" class="btn btn-outline-success"><a href="#" style="color: green"><i class="fas fa-map-marker"></i>  Xem bản đồ google</a></button>
					</div>
					<div class="col-md-4">
						<p class="font-weight-bold">Điện Thoại</p>
						<p class="font-weight-light" style="font-size: 14px"><?= $web_settings['hotline'] ?></p>
						<p class="font-weight-bold">Email</p>
						<p class="font-weight-light" style="font-size: 14px"><?= $web_settings['email'] ?></p>
					</div>
					<div class="col-md-4">
						<p class="font-weight-bold">Thời gian mở cửa</p>
						<p class="font-weight-light" style="font-size: 14px">Thứ 2-6: 8h - 18h</p>
						<p class="font-weight-light" style="font-size: 14px">Thứ 7: 8h30 - 17h</p>
						<p class="font-weight-light" style="font-size: 14px">Nghỉ CN và các ngày lễ</p>
					</div>
				</div>
			</div>
			<div class="row pt-2">
				<div class="col-md-12">
					<?= $web_settings['map'] ?>
				</div>
			</div>
			<div class="row pt-3">
				<div class="col-md-12">
					<h5>Thông tin liên hệ</h5><hr>
					
					<form class="w-100 pt-2 pb-4" method="post" id="formcontact" action="submit_contacts.php">

						<div class="form-row ">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Email</label>
								<input type="email" class="form-control" id="inputEmail4" name="email">
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Tên</label>
								<input type="text" class="form-control" id="inputname" name="name" >
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress">Địa chỉ</label>
							<input type="text" class="form-control" id="inputAddress" name="address" >
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Tin nhắn</label>
							<textarea name="messenger" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-outline-success w-30"></span>
							Gửi đi</button>
						</div>
					</form>	
				</div>
			</div>
			<hr>
		</div>
	</div>
	<?php require './share/footer.php'; ?>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$(function () {
			<?php if (isset($_GET['notice']) && $_GET['notice'] !== null):
				?>
				swal({
					title: "Thông báo !!!",
					text: "<?= $_GET['notice']?>",
					icon: "success",
				});
			<?php endif;?>
		});
	</script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
		$().ready(function() {
			$("#formcontact").validate({
				onfocusout: false,
				onkeyup: false,
				onclick: false,
				rules: {
					"email": {
						required: true,
						email: true
					},
					"nameuser": {
						required: true,
					},
					"address":{
						required: true,
					},
					"name":{
						required: true,
					},
					"city":{
						required: true,
					},
					"state":{
						required: true,
					},
					"zip":{
						required: true,
						number: true
					},
					"messenger":{
						required: true,
					}
				},
				messages: {
					"email": {
						required: "<p class='mb-0' style='color: red;'>Bạn cần nhập email !!!</p>",
						email: "<p class='mb-0' style='color: red;'>Cần nhập đúng định dạng !!!</p>"
					},
					"name": {
						required: "<p class='mb-0' style='color: red;'>Vui lòng điền tên !!!</p>"
					},
					"address":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng nhập địa chỉ !!!</p>"
					},

					"state":{
						required: "<p class='mb-0' style='color: red;'>You must fill box state !!!</p>"
					},

					"messenger":{
						required: "<p class='mb-0' style='color: red;'>Vui lòng điền nội dung tin nhắn</p>",
						maxlength: "<p class='mb-0' style='color: red;'>You just type 200 word</p>"
					}
				}
			});
		});
	</script>

</body>
</html>