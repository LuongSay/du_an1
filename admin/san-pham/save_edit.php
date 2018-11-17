<?php 
require_once '../../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('location: ' . $adminUrl . 'san-pham');
	die;
}


$id = $_POST['id'];
$sql = "select * from ". TABLE_PRODUCT . " WHERE id='$id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$product = $stmt->fetch();
$product_name = $_POST['product_name'];
$detail = $_POST['detail'];
$list_price = $_POST['list_price'];
$sell_price = $_POST['sell_price'];
$cate_id = $_POST['cate_id'];
$img = $_FILES['image'];
$image = $product['image'];
$status = $_POST['status'];
$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$filename = 'public/img/'.uniqid() . '.' . $ext;
move_uploaded_file($img['tmp_name'], '../../'.$filename);
if ($sell_price >= $list_price) {
	header('location: '. $adminUrl. 'san-pham/add.php?msg2= Giá khuyến mãi không được lớn giá bán !!!');
	die;
};
if ($img['name'] == "") {
	$filename = $image;
};
$sql = "UPDATE products SET product_name=:product_name,cate_id=:cate_id,list_price=:list_price,sell_price=:sell_price,status='$status',image=:image,detail=:detail where id= $id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":product_name", $product_name);
$stmt->bindParam(":cate_id", $cate_id);
$stmt->bindParam(":list_price", $list_price);
$stmt->bindParam(":sell_price", $sell_price);
$stmt->bindParam(":image", $filename);
$stmt->bindParam(":detail", $detail);
$stmt->execute();

header('location: ' . $adminUrl . 'san-pham');
 ?>