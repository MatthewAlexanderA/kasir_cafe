<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

//ambil data di url
$id = $_GET["id"];

//query data siswa berdasarakan id
$kasir = query("SELECT * FROM tb_user WHERE id = $id")[0];


//cek tombol submit udh di tekan blm
if (isset($_POST['submit'])) {
	
	//cek apakah data berahsil di ubah?
	if ( edit($_POST) > 0 ) {
		echo "

			<script>
				alert('Data Berhasil Diubah');
				document.location.href = '../page/kasir.php';
			</script>
		";
	}
	else{
		echo "

			<script>
				alert('Data Gagal Diubah');
				document.location.href = '../page/kasir.php';
			</script>
		";
	}
	
}

$role = $_SESSION['role'] OR $_COOKIE['role'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Menu</title>
	<link rel="stylesheet" type="text/css" href="../css/ubah.css">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
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
		<h1>Edit Kasir</h1>
	</header>
	
	<div class="content" style="padding-top: 35px; padding-bottom: 100px;">
		<form method="post" action="">
			<input type="hidden" name="id" value="<?= $kasir["id"]; ?>">
			

			<div class="insert">
				<label class="label" for="username">Username : </label>
				<input class="input" autocomplete="off" type="text" name="username" id="username" required value="<?= $kasir["username"]; ?>" style="width: 250px;">
			</div>

			<div class="insert">
				<label class="label" for="password">Password : </label>
				<input class="input" autocomplete="off" type="text" name="password" id="password" required value="<?= $kasir["password"]; ?>" style="width: 250px;">
			</div>

			<br><br><br>
			<button class="btn" type="submit" name="submit">Ubah Data</button>

		</form>
	</div>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>