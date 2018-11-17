<?php 
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'danh-muc');
	die;
}
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
if(!$name){
	header('location: ' . $adminUrl . 'danh-muc/save-edit.php?errName=Vui lòng nhập tên danh mục');
	die;
}
$sql = "update " . TABLE_CATEGORY . " 
		set
			name = :name,
			description = :description
			where id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":description", $description, PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_STR);
$stmt->execute();
header('location: ' . $adminUrl . 'danh-muc?success=true');
 ?>