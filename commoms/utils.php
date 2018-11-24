<?php
$host = "localhost";
$dbname="selena_duan1";
$dbusername ="root";
$dbpwd="";
$siteUrl = "http://localhost/Leaning-PHP/du_an1/";
$adminUrl = "http://localhost/Leaning-PHP/du_an1/admin/";
$adminAssetUrl = "http://localhost/Leaning-PHP/du_an1/admin/adminlte/";
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$dbusername",$dbpwd);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
define('TABLE_CATEGORY','categories');
define('TABLE_SLIDESHOW','slideshows');
define('TABLE_PRODUCT','products');
define('TABLE_WEBSETTING','web_settings');
define('TABLE_COMMENT', 'comments');

function dd($var){
	echo "<pre>";
	var_dump($var);
	die;
};
const USER_ROLES = [
	'admin' => 500,
	'moderator' => 300,
	'member' => 1
];
function checkLogin($role = 300){
	global $siteUrl;
	if(!isset($_SESSION['login']) 
		|| $_SESSION['login'] == null
		|| $_SESSION['login']['role'] < $role){
	  header('location: '.$siteUrl . 'admin/err.php');
	  die;
	}
};

?>