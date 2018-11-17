<?php 
session_start();

require_once '../../commons/ultis.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'profile');
	die;
}
$id = $_POST['id'];
$name = $_POST['name'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'adminlte/dist/img/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);

$old_filename = $_POST['old_filename'];

if ($img['name'] === "" || $img['size'] === 0 ) {
	$filename = $old_filename;
}
$imageFileType = strtolower($ext);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$filename = $old_filename;
	
}


if(!$name){
	header('location: ' . $adminUrl . 'profile/edit.php?id='.$id.'&errName=Vui lòng nhập tên danh mục');
	die;
}

$sql = "update users set fullname = :name, avatar = :image where id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
header('location: ' . $adminUrl . 'profile');
 ?>