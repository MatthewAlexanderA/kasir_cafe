<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$id = $_GET['id'];

$cart = $_SESSION['cart'];
// print_r($cart);

// mengambil data secara spesifik
$k = array_filter($cart, function ($var) use ($id){
	return ($var['id']==$id);
});

foreach ($k as $key => $value) {
	unset($_SESSION['cart'][$key]);
}

// mengembalikan urutan array
$_SESSION['cart'] = array_values($_SESSION['cart']);

header("Location: ../page/order.php");

 ?>