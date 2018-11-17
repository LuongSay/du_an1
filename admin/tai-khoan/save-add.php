<?php 
session_start();
require_once '../../commoms/utils.php';
checkLogin(USER_ROLES['admin']);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tai-khoan');
	die;
}
$sql = "select * from users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$us = $stmt->fetchAll();
//dd($us);
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$cfPassword = $_POST['cfPassword'];
$role = $_POST['role'];
$phone = $_POST['sdt'];
foreach ($us as $u) {
	if ($email == $u['email']) {
		header('location: ' . $adminUrl . 'tai-khoan/add.php?msg2=Email đã được sử dụng!');
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
			:role)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":fullname", $fullname);
$stmt->bindParam(":password", $password);
$stmt->bindParam(":role", $role);
$stmt->execute();
header('location: ' . $adminUrl . 'tai-khoan');
 ?>