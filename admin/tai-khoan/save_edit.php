<?php 
session_start();
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'tai-khoan');
	die;
}
$id = $_POST['id'];
$email = $_POST['email'];
$sql = "SELECT * FROM users WHERE id not in ('$id')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $c) {
	if (strtolower($email) == strtolower($c['email'])) {
		header('location: ' . $adminUrl . 'tai-khoan/edit.php?id='.$id.'&msg1=Email đã được sử dụng!');
		die;
	}
}

$fullname = $_POST['fullname'];
$password = $_POST['password'];
$password1 = $_POST['password1'];
$role = $_POST['role'];
$phone = $_POST['sdt'];

if (empty($password)) {
	$password = $password1;
};


$password = password_hash($password, PASSWORD_DEFAULT);

$sql= "UPDATE users SET email='$email',fullname='$fullname',password='$password',role='$role',phone_number='$phone' WHERE id ='$id'";

$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: ' . $adminUrl . 'tai-khoan?msg2=Thành công');


?>