<?php
require_once './commoms/utils.php';
$sql = "select * from users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$us = $stmt->fetchAll();
//dd($us);
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$cfPassword = $_POST['cfPassword'];
$phone = $_POST['sdt'];
foreach ($us as $u) {
	if ($email == $u['email']) {
		header('location: ' . $siteUrl.'registered.php?msg2=Email đã được sử dụng!');
	die;
	}};
// email xem có tồn tại không
// mật khẩu có nằm trong khoảng từ 6-20 ký tự không
$password = password_hash($password, PASSWORD_DEFAULT);
$sql = "insert into users
			(email, 
			fullname, 
			password,
			phone_number, 
			role)
		values 
			(:email, 
			:fullname, 
			:password,
			'$phone',
			'1')";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":password", $password);
$stmt->execute();
header('location: ' . $siteUrl.'registered.php?msg1=Đăng kí thành công. Bạn có thể đăng nhập !');
 ?>