<?php 
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'danh-muc');
	die;
}
$name = $_POST['name'];

$sql = "select * from ".TABLE_CATEGORY." where name = '$name'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cates = $stmt->fetch();

if ($cates != false) {
	header('location: '. $adminUrl. 'danh-muc/add.php?msg2=Đã tồn tại tên danh mục. Vui lòng chọn tên khác !!!');
	die;
}

$desc = $_POST['desc'];
$sql = "insert into " . TABLE_CATEGORY . " 
		values
			(null, :name, :desc)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":desc", $desc, PDO::PARAM_STR);
$stmt->execute();
header('location: ' . $adminUrl . 'danh-muc?success=true');
 ?>