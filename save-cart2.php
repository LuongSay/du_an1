<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
require_once 'commoms/utils.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('location: '.$siteUrl.'detail-cart.php');
};
if (!isset($_SESSION['CART']) || count($_SESSION['CART']) == 0) {
	header('location: '.$siteUrl.'detail-cart.php?msg1=Giỏ hàng hiện tại đang trống !!!');
	die;
};
 // dd($cart);
$list_price = $cart['list_price'];
$name = $_POST['name'];
$phone =$_POST['phone'];
$email = $_POST['email'];
$note = $_POST['note'];
$totalPrice = $_POST['totalPrice'];

//insert invoices
if (isset($_SESSION['login'])) {
	$name = $_SESSION['login']['fullname'];
	$email = $_SESSION['login']['email'];
	$phone = $_SESSION['login']['phone_number'];
	$sql = "insert into invoices(customer_name,customer_phone,total_price,customer_email, note,status) VALUES ('$name','$phone','$totalPrice','$email','$note','0')";
}else{
	$sql = "insert into invoices(customer_name,customer_phone,total_price,customer_email, note,status) VALUES ('$name','$phone','$totalPrice','$email','$note','0')";
};
$conn->exec($sql);

//lay id cuoi cung
$id_invoice = $conn->lastInsertId();

// insert invoices_details
foreach ($cart as $value) {
	$id_product = $value['id'];
	$quanlity = $value['quantity'];
	$list_price = $value['list_price'];
	$total = $quanlity * $list_price;
	$sql = "insert into invoice_details(product_id,invoice_id,quanlity,unit_price,total_price) VALUES ('$id_product','$id_invoice','$quanlity','$list_price','$total')";
	$conn->exec($sql);
}
unset($_SESSION['CART']);
header('location: '.$siteUrl.'detail-cart.php?msg=Đặt hàng thành công. Chúng tôi sẽ sớm liên lạc với bạn !')
?>
