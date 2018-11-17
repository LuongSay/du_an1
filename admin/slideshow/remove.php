<?php 
$path = '../';
require_once '../../commoms/utils.php';

$id = $_GET['id'];
$sql = "select * from slideshows WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
$users = $stsm->fetch();
if (!$users) {
	header('location: '. $adminUrl. "slideshow");
	die;
}
$sql = "DELETE FROM slideshows WHERE id = $id";
$stsm = $conn->prepare($sql);
$stsm->execute();
header('location: '. $adminUrl. "slideshow");
?>
?>