<?php 
$path = '../';
require_once '../../commoms/utils.php';
$id = $_GET['id'];
$sql = "select * from ".TABLE_PRODUCT." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$product = $stsm->fetch();
if (!$product) {
	header('location: '. $adminUrl. "san-pham");
	die;
}
$sql = "DELETE FROM ".TABLE_PRODUCT." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();


/*$sql = "DELETE FROM ".TABLE_COMMENT." WHERE product_id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute(); */

header('location: '. $adminUrl. "san-pham");
?>