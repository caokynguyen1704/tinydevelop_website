<?php 
ob_start(); 
session_start();
?>

<?php
$_dir="/function/";
$url = $_SERVER['DOCUMENT_ROOT'];
require $url.$_dir."main.php";
?>


<?php ob_flush(); ?>