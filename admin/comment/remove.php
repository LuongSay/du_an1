<?php 
$path = '../';
require_once '../../commoms/utils.php';

$id = $_GET['id'];
$sql = "select * from ".TABLE_COMMENT." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$comment = $stsm->fetch();
if (!$comment) {
	header('location: '. $adminUrl. "comment");
	die;
}
$sql = "DELETE FROM ".TABLE_COMMENT." WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
header('location: '. $adminUrl. "comment");
?>