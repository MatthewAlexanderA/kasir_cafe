<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$total = $_POST['total']; 

foreach ($_SESSION['cart'] as $key => $value) {
	$_SESSION['cart'][$key]['total'] = $total[$key];
}

header("Location: ../page/order.php");

 ?>