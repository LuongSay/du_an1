<?php 
$path = "";
require_once '../commoms/utils.php';
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript">
		function goBack() {
			window.history.back();
		}
		
		</script>
<style type="text/css">
	body{
		text-align: center;
	}
	h1{
		color: red;
	}
</style>
</head>
<body>
	<h1>Bạn không có quyền truy cập vào đây. Vui lòng quay lại !</h1>
	<button><a href="<?= $siteUrl ?>admin">Quay về</a></button>
</body>
</html>