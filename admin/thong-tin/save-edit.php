<?php
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location: ' . $adminurl . 'setting');
    die;
}
$id = $_POST['id'];
$sql = "select * from web_settings";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();
$phone = $_POST['phone'];
$email = $_POST['email'];
$map =$_POST['map'];
$fb = $_POST['fb'];
$img = $_FILES['image'];
$image = $_POST['image_cf'];


$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
if ($img['name'] == "") {
	$filename = $image;
};
$sql = "UPDATE web_settings SET logo='$filename',hotline='$phone',email='$email',map='$map',fb='$fb'";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: '.$adminUrl.'thong-tin');
?>