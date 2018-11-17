<?php 
session_start();


require_once '../../commoms/utils.php';

checkLogin();

$id = $_GET['id'];

$sql = "select * from brands where id = $id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$cate = $stmt->fetch();

if(!$cate){
	header('location: ' . $adminUrl . "doi-tac");
	die;
}

// xoa san pham thuoc ve danh muc nay
$sql = "delete from brands where id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();



header('location: ' . $adminUrl . "doi-tac");


 ?>