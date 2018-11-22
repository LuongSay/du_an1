<?php 
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'danh-muc');
	die;
}
$id = $_POST['id'];
$sql = "select * from categories WHERE id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates= $stmt->fetch();

$img = $_FILES['image1'];
$image = $_POST['image'];
var_dump($image);
$ext = pathinfo($img['name'],PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid().'.'.$ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);

if ($img['name'] == "") {
	$filename = $image;
}
$sql = "update " . TABLE_CATEGORY . "
set
name = :name,
image = '$filename' where id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();
header('location: ' . $adminUrl . 'danh-muc?success=true');
?>