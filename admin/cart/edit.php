<?php 
require_once '../../commoms/utils.php';;
$id = $_GET['id'];
$sql = "SELECT * FROM invoices WHERE id='$id'";
$stmt = $conn->prepare($sql);;
$stmt->execute();
$invoices = $stmt->fetch();

if ($invoices['status'] == 0 ) {
	$sql = "UPDATE invoices SET status=1 WHERE id ='$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}else{
	$sql = "UPDATE invoices SET status=0 WHERE id ='$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
};
header('location: '.$adminUrl.'cart')
 ?>
