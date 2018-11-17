<?php 
require_once 'commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] == "GET"){
	header('location: '. $siteUrl);
	die;
}


$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$adress = $_POST['address'];
$messenger = $_POST['messenger'];

$sql = "INSERT INTO contacts (id,email,name,address,messenger) VALUES('$id','$email','$name','$adress','$messenger')";
$stmt = $conn->prepare($sql);
$stmt->execute();
header('location: '. $siteUrl . 'lienhe.php?notice=Gửi liên hệ thành công');
?>