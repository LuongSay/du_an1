<?php 
$path = '../';
require_once '../../commoms/utils.php';

$id = $_GET['id'];
$sql = "select * from users WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$users = $stsm->fetch();
if (!$users) {
	header('location: '. $adminUrl. "tai-khoan");
	die;
}
$sql = "DELETE FROM users WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
header('location: '. $adminUrl. "tai-khoan");
?>
?>