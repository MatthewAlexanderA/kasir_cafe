<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

//cek tombol submit udh di tekan blm
if (isset($_POST['submit'])) {
	
	//cek apakah data berahsil di tambahkan?
	if ( tambah($_POST) > 0 ) {
		echo "

			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href = '../page/edit_menu.php';
			</script>
		";
	}
	else{
		echo "

			<script>
				alert('Data Gagal Ditambahkan');
				document.location.href = '../page/edit_menu.php';
			</script>
		";
	}
	
}

$role = $_SESSION['role'] OR $_COOKIE['role'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Menu</title>
	<link rel="stylesheet" type="text/css" href="../css/tambah.css">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" style="color: #60ef65;" href="../page/edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="../page/order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="../page/history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" href="../page/kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="../page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" href="../page/order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="../page/history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="../page/logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>Tambah Menu</h1>
	</header>

	<div class="content">

		<form method="post" action="" enctype="multipart/form-data">
			
			<div class="insert">
				<label class="label" for="nama"><b>Nama :<b></label>
				<input class="input" type="text" name="nama" id="nama" autocomplete="off">
			</div>
				
			<div class="insert">
				<label class="label" for="harga"><b>Harga :<b></label>
				<input class="input" type="text" name="harga" id="harga">
			</div>
				
			<div class="insert">
				<label class="label" for="gambar">Gambar </label>
				<input class="input" type="file" name="gambar" id="gambar">
			</div>
				
			<br><br><br>
			<button class="btn" type="submit" name="submit">Tambah Data!</button>
			

		</form>

	</div>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>