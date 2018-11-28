<?php
session_start();
require_once 'commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] == "GET"){
	header('location: '. $siteUrl);
	die;
}
$pId = $_POST['id'];
$email = $_POST['email'];
$content = $_POST['content'];
if (isset($_SESSION['login'])) {
	$email = $_SESSION['login']['email'];
};
$sql = "insert into " . TABLE_COMMENT
. " (email, content, product_id) 
values ('$email', '$content',  $pId)";
$stmt = $conn->prepare($sql);
$stmt->execute();
header('location: '. $siteUrl . 'chi-tiet-sp.php?id=' . $pId.'&&success=true');

?>