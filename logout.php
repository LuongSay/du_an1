<?php 
session_start();
require_once './commoms/utils.php';
session_destroy();
header('location: '.$siteUrl.'index.php')
 ?>