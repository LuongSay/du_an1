<?php
	session_start();
	$id = $_GET['id'];
	$flag = -1;
	$cart = $_SESSION['CART'];
	foreach ($cart as $key => $value) {
		if($value['id'] == $id){
			$flag = $key;
			break;
		}
	}
	if($flag != -1){
		unset($_SESSION['CART'][$flag]);
	}
	
	header('location: detail-cart.php');
	
?>