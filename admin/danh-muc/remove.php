<?php 
$path = '../';
require_once '../../commoms/utils.php';
session_start();
$id = $_GET['id'];
$sql = "select * from ".TABLE_CATEGORY." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$cate = $stsm->fetch();
if (!$cate) {
	header('location: '. $adminUrl. "danh-muc");
	die;
}
$sql = "DELETE FROM ".TABLE_PRODUCT." WHERE cate_id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();


$sql = "DELETE FROM ".TABLE_CATEGORY." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();

header('location: '. $adminUrl. "danh-muc");
?>