<?php
session_start();
$path = '../';
require_once '../../commoms/utils.php';

$id = $_GET['id'];

$sql = "select * from users WHERE id = $id";

$stsm = $conn->prepare($sql);
$stsm->execute();
$users = $stsm->fetch();

$role = $users['role'];
if (!$users) {
	header('location: '. $adminUrl. "tai-khoan");
	die;
}

$idS = $_SESSION['login']['id'];

if ($idS != $id && $role < 500) {
	$sql ="DELETE FROM users WHERE id = '$id'";
};
$stsm = $conn->prepare($sql);
$stsm->execute();

header('location: '. $adminUrl. "tai-khoan");
?>
?>