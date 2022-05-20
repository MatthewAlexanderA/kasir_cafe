<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$menu = query("SELECT * FROM tb_makanan");

//tombol cari ditekan
if (isset($_POST['cari'])) {
	$menu = cari($_POST['keyword']);
}

$role = $_SESSION['role'] OR $_COOKIE['role'];

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" style="color: #60ef65;" href="edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" href="kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>Daftar Menu</h1><br>
	</header>

	<div class="content">
	
	<form action="" method="post">
		
		<input class="search" type="text" name="keyword" size="40" placeholder="Masukan Nama Menu" autocomplete="off">
		<button class="btn" id="cari" type="submit" name="cari">Cari</button>

	</form><br>

	<div class="tambah">
		<a href="../fitur/tambah.php">Tambah Menu</a>
	</div>

	<br>

	<center>
			<div class="row">
			<?php foreach ($menu as $row) : ?>
				
				<div class="column">
					<div class="card">
						<center>

							<div class="gambar">
								<img src="../img/<?= $row["gambar"]; ?>" width="90px;">
							</div>

						</center>

						<p><?= $row["nama"]; ?></p>
						<p><?= $row["harga"]; ?></p>
						<p class="btn">
							<button class="edit">
								<a href="../fitur/ubah.php?id=<?= $row["id"]; ?>">Edit</a>
							</button> 
							<button class="delete">
								<a href="../fitur/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" >Delete</a>
							</button>
						</p>

					</div>
				</div>


			<?php endforeach; ?>

			</div>
	</center>
	</div>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>