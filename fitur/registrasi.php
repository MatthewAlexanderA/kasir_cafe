<?php 
session_start();
require '../functions/functions.php';

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

if (isset($_POST['register'])) {
	
	if (registrasi($_POST) > 0) {
		echo "<script>
				alert('Kasir Baru Berhasil Ditambahkan!');
				document.location.href = '../page/kasir.php';
			 </script>";
	}
	else{
		echo mysqli_error($conn);
	}

}

$role = $_SESSION['role'] OR $_COOKIE['role'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrasion Page</title>
	<style type="text/css">
		label {
			display: block;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<link rel="stylesheet" type="text/css" href="../css/registrasi.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" href="../page/edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="../page/order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="../page/history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" style="color: #60ef65;" href="../page/kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="../page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" href="../page/order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="../page/history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="../page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>Halaman Registrasi</h1>
	</header>


	<div class="content">
	<form action="" method="post">


		<div class="insert">
			<label class="label" for="username"><b>Username :<b></label>
			<input class="input" type="text" name="username" id="username" autocomplete="off">
		</div>
			
		<div class="insert">
			<label class="label" for="password"><b>Password :<b></label>
			<input class="input" type="password" name="password" id="password">
		</div>
			
		<div class="insert">
			<label class="label" for="password2"><b>Konfirmasi Password :<b></label>
			<input class="input" type="password" name="password2" id="password2">
		</div>
			
		<br><br><br>
		<button class="btn" type="submit" name="register">Register !</button>
			

	</form>
	</div>


	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>