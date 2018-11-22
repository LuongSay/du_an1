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

$img = $_FILES['image'];
$ext = pathinfo($img['name'],PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid().'.'.$ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
$sql = "insert into " . TABLE_CATEGORY . "
(name,image)
values
('$name','$filename')";
$stmt = $conn->prepare($sql);
$stmt->execute();
header('location: ' . $adminUrl . 'danh-muc?success=true');
?>