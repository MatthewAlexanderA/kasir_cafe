<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';


$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM tb_makanan WHERE id = '$id'");
	
$b = mysqli_fetch_assoc($data);

$menu = [
	'id' => $b['id'],
	'nama' => $b['nama'],
	'harga' => $b['harga'],
	'total' => 1
];

$_SESSION['cart'][] = $menu;


header('Location: ../page/order.php');

	
 ?>