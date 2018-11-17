<?php 
session_start();
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tai-khoan');
	die;
}
$id = $_POST['id'];
$email = $_POST['email'];
$sql = "SELECT * FROM users WHERE id NOT IN='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
$fullname = $_POST['fullname'];
$password = $_POST['password'];
$password1 = $_POST['password1'];
$role = $_POST['role'];
$phone = $_POST['sdt'];

if (empty($password)) {
	$password = $password1;
};

// email xem có tồn tại không
// mật khẩu có nằm trong khoảng từ 6-20 ký tự không
$password = password_hash($password, PASSWORD_DEFAULT);

$sql= "UPDATE users SET email='$email',fullname='$fullname',role='$role',phone_number='$phone' WHERE id='$id'";

$stmt = $conn->prepare($sql);
$stmt->execute();

	header('location: ' . $adminUrl . 'tai-khoan?msg2=Gửi liên hệ thành công');


 ?>