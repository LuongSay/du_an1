<?php 
require_once '../../commoms/utils.php';
$id = $_GET['id'];

$sql = "select * from contacts WHERE id = '$id'";
$stsm = $conn->prepare($sql);
$stsm->execute();
$checkContact = $stsm->fetch();
if (!$checkContact) {
	header('location: '. $adminUrl. "lien-he");
	die;
}
$sql = "DELETE FROM contacts WHERE id = '$id'";
$stsm = $conn->prepare($sql);
$stsm->execute();
header('location: '. $adminUrl. "lien-he");
?>