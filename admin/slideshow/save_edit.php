<?php 
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'slideshow');
	die;
}

$slideshowId = $_POST['id'];
$sql = "select * from slideshows where id = '$slideshowId'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$slideshow = $stmt->fetch();
$url = $_POST['url'];
$status = $_POST['status'];
$img = $_FILES['image'];
$desc= $_POST['desc'];

$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid() . '.' . $ext;
$image = $slideshows['image'];
$old_filename = $_POST['old_filename'];
if ($img['name'] === "") {
	$filename = $old_filename;
}else {
	move_uploaded_file($img['tmp_name'], '../../'.$filename);
}
$sql = "UPDATE slideshows SET url=:url,status=:status,image=:image,desc='$desc' WHERE id = '$slideshowId'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":url", $url);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":image", $filename);
$stmt->execute();

header('location: ' . $adminUrl . 'slideshow');
 ?>