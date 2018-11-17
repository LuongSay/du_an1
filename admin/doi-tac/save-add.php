<?php 
session_start();


require_once '../../commoms/utils.php';

checkLogin();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'doi-tac');
	die;
}
$name = $_POST['name'];
$img = $_FILES['image'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid() . '.' . $ext;

move_uploaded_file($img['tmp_name'], '../../'.$filename);


if(!$name){
	header('location: ' . $adminUrl . 'doi-tac/add.php?errName=Vui lòng nhập tên đối tác');
	die;
}

$sql = "insert into brands
		(name, image)
		values
			(:name, :image)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":image", $filename);

$stmt->execute();
header('location: ' . $adminUrl . 'doi-tac?success=true');

 ?>