<?php 
session_start();
$cart = isset($_SESSION['CART']) == true ? $_SESSION['CART'] : [];

require_once 'commoms/utils.php';
// dd($_SESSION['CART']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$note = $_POST['note'];
	$qtt =  $cart['quantity'];
	foreach ($qtt as $key ) {
		echo $key;
	};
		$sql = "INSERT INTO invoices (customer_name,customer_phone,total_price,customer_email,note) values ('$name','$phone','$totalPrice',$email','$note')";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	
}
?>
