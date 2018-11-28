<?php 
session_start();
require_once '../commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'GET'){
	header('location: '.$siteUrl.'detail-cart.php');
	die;
}
$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
date_default_timezone_set("Asia/Ho_Chi_Minh");

$id = $_GET['id'];
// kiem tra xem id sp nay co trong phan products hay khong ?
$item = false;
foreach ($products as $pro) {
	if($id == $pro['id']){
		$item = $pro;
		break;
	}
}

$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
if(count($cart) == 0){
	// 1. khong ton tai gio hang/gio hang rong
	// ==> tang quantity cua item => 1 
	// => luu vao trong gio hang
	$item['quantity'] = 1;
	array_push($cart, $item);
}else{
	// 2. co gio hang
	$flag = -1;
	for ($i=0; $i < count($cart); $i++) {
		if($item['id'] == $cart[$i]['id']){
			$flag = $i;
			break;
		}
	}

	// flag == -1 ==> sp k co trong gio hang
	if($flag == -1){
		$item['quantity'] = 1;
		array_push($cart, $item);
	}else{
		// flag != -1 ==> sp co trong gio hang
		$qty = $cart[$flag]['quantity'] - 1;
		if ($qty < 1) {
			header('location: '.$siteUrl.'detail-cart.php');
			die;
		} else{
			$cart[$flag]['quantity'] = $qty;
		}
	}
}

$_SESSION['CART'] = $cart;
header('location: '.$siteUrl.'detail-cart.php');

 ?>