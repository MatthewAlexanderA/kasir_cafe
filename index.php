<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

require 'functions/functions.php';

$role = $_SESSION['role'] OR $_COOKIE['role'];
$user = $_SESSION['username'] OR $_COOKIE['username'];

date_default_timezone_set("Asia/Jakarta");
$jam = date('H:i');

if ($jam > '04:00' && $jam < '10:00') {
    $waktu = 'Pagi';
} 
elseif ($jam >= '10:00' && $jam < '15:00') {
    $waktu = 'Siang';
} 
elseif ($jam < '18:00') {
    $waktu = 'Sore';
} 
else {
    $waktu = 'Malam';
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" style="color: #60ef65;" href="index.php"><img class="home" src="img/icon/home.png"> Home</a> | 
		<a class="edit-menu" href="page/edit_menu.php"><img class="edit-menu" src="img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="page/order.php"><img class="order" src="img/icon/order.png"> Order</a> | 
		<a class="history" href="page/history.php"><img class="history" src="img/icon/history.png"> History</a> | 
		<a class="regis" href="page/kasir.php"><img class="regis" src="img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" style="color: #60ef65;" href="index.php"><img class="home" src="img/icon/home.png"> Home</a> | 
		<a class="order" href="page/order.php"><img class="order" src="img/icon/order.png"> Order</a> | 
		<a class="history" href="page/history.php"><img class="history" src="img/icon/history.png"> History</a> | 
		<a class="logout" href="page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<span><b>Forrst Cafe.</b></span><br>
		<span class="p">Enjoy your Time!</span>
	</header>


	<div class="content">

		<h1>Selamat <?= $waktu ?>.</h1>
		<h2><?= strtoupper($user); ?></h2>

	</div>


	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>


</body>
</html>