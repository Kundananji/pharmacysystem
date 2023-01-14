<?php session_start();
$_SESSION['QUERI_STRING']=$_SERVER['QUERY_STRING'];
$params = isset($_SESSION['QUERI_STRING'])?("?".$_SESSION['QUERI_STRING']):'';
header('location:dashboard.php'.$params);
?>