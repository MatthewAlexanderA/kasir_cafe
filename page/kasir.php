<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

require '../functions/functions.php';

$role = $_SESSION['role'] OR $_COOKIE['role'];

$kasir = query("SELECT * FROM tb_user WHERE role = 2");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Kasir</title>
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/kasir.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" href="edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" style="color: #60ef65;" href="kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>Daftar Kasir</h1>
	</header>

	<div class="content" style="padding-bottom: 35px;">
		
		<form action="" method="post">
			
			<input class="search" type="text" name="keyword" size="40" placeholder="Masukan Nama Kasir" autocomplete="off">
			<button class="btn" id="cari" type="submit" name="cari">Cari</button>

		</form><br>

		<div class="tambah">
			<a href="../fitur/registrasi.php">Registrasi Kasir Baru</a>
		</div>

		<br>

		<table border="1" cellpadding="10" cellspacing="0">
			
			<tr>
				<th>No.</th>
				<th>Username</th>
				<th>Password</th>
				<th>Edit/Delete</th>
			</tr>

			<?php $i = 1; ?>
			<?php foreach ($kasir as $row) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td style="width: 300px;"><?= $row["username"]; ?></td>
				<td style="width: 250px;"><?= $row["password"]; ?></td>
				<td class="btn">
					<button class="edit">
						<a href="../fitur/ubah_kasir.php?id=<?= $row["id"]; ?>">Edit</a>
					</button> 
					<button class="delete">
						<a href="../fitur/hapus_kasir.php?id=<?= $row["id"]; ?>" onclick="return confirm('Delete?');" >Delete</a>
					</button>
				</td>
			</tr>
			<?php $i++ ?>
			<?php endforeach; ?>

		</table>

	</div>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>