<?php
session_start();
require './commoms/utils.php';
$key = intval(getInput("key"));
$qty = intval(getInput("qty"));

$_SESSION['CART']['quantity']=$qty;
echo "1";
 ?>

