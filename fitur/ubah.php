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
$makan = query("SELECT * FROM tb_makanan WHERE id = $id")[0];


//cek tombol submit udh di tekan blm
if (isset($_POST['submit'])) {
	
	//cek apakah data berahsil di ubah?
	if ( ubah($_POST) > 0 ) {
		echo "

			<script>
				alert('Data Berhasil Diubah');
				document.location.href = '../page/edit_menu.php';
			</script>
		";
	}
	else{
		echo "

			<script>
				alert('Data Gagal Diubah');
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
	<title>Edit Menu</title>
	<link rel="stylesheet" type="text/css" href="../css/ubah.css">
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
		<h1>Edit Menu</h1>
	</header>

	<div class="content">
		<form method="post" action="" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $makan["id"]; ?>">
			<input type="hidden" name="gambarLama" value="<?= $makan["gambar"]; ?>">


			<table>

				<tr>

					<td rowspan="2">
						<div class="insert">
							<label class="label" for="gambar">Gambar : </label>
							<img class="input" src="../img/<?= $makan["gambar"]; ?>" width="150px;" style="border: 2px solid black;"><br>
							<input class="input" type="file" name="gambar" id="gambar" style="width: 250px;">
						</div>
					</td>

					<td>
						<div class="insert">
							<label class="label" for="nama">Nama : </label>
							<input class="input" autocomplete="off" type="text" name="nama" id="nama" required value="<?= $makan["nama"]; ?>" style="width: 250px;">
						</div>
					</td>

				</tr>

				<tr>
					<td>
						<div class="insert">
							<label class="label" for="harga">Harga : </label>
							<input class="input" autocomplete="off" type="text" name="harga" id="harga" required value="<?= $makan["harga"]; ?>" style="width: 250px;">
						</div>
					</td>
				</tr>

			</table>

			

			<br><br><br>
			<button class="btn" type="submit" name="submit">Ubah Data!</button>

		</form>
	</div>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>