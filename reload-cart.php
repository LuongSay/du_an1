<?php 
session_start();
$item['quantity'] = $_POST['quantity'];
header('location:detail-cart.php' );
 ?>