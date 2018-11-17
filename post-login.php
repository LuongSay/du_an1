<?php 
session_start();
require_once './commoms/utils.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
 header('location: '. $siteUrl . 'login.php');
 die;
}
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "select * 
		from users
		where email = '$email'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetch();
if(!$user || !password_verify($password, $user['password'])){
	header('location: '. $siteUrl . 'login.php?msg=Sai email/mật khẩu!');
	die;
};

// $_SESSION['login'] = null;
$_SESSION['login'] = $user;
 ?>	
 <script type="text/javascript">
 	setTimeout(function(){
 		window.location.href = '<?= $adminUrl ?>';
 	}, 0.1);
 </script>