<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];
require_once 'commoms/utils.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('location: '.$siteUrl.'detail-cart.php');
};
 // dd($cart);
$list_price = $cart['list_price'];
$name = $_POST['name'];
$phone =$_POST['phone'];
$email = $_POST['email'];
$note = $_POST['note'];
$totalPrice = $_POST['totalPrice'];

//insert invoices
$sql = "insert into invoices(customer_name,customer_phone,total_price,customer_email, note,status) VALUES ('$name','$phone','$totalPrice','$email','$note','0')";
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
header('location: '.$siteUrl.'detail-cart.php?lưu thành công')
?>
