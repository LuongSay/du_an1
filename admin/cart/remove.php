<?php 
$path = '../';
require_once '../../commoms/utils.php';
$id = $_GET['id'];
$sql = "select * from invoices WHERE id = '$id'";
$stsm = $conn->prepare($sql);
$stsm->execute();
$invoices = $stsm->fetch();
if (!$invoices) {
	header('location: '. $adminUrl. "cart");
	die;
}
$sql = "DELETE FROM invoices WHERE id = '$id'";
$stsm = $conn->prepare($sql);
$stsm->execute();
$sql = "DELETE FROM invoice_details WHERE invoice_id = '$id'";
$stsm = $conn->prepare($sql);
$stsm->execute();


header('location: '. $adminUrl. "cart");
?>