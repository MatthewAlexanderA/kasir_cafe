<?php 
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$role = $_SESSION['role'] OR $_COOKIE['role'];

$history = query("SELECT * FROM `tb_transaksi` ORDER BY tanggal_waktu DESC");
$sort = "tanggal_waktu DESC";

if (isset($_POST['sort'])) {
	$sort = $_POST['sort'];
	$history = query("SELECT * FROM `tb_transaksi` ORDER BY $sort");
}

if (isset($_POST['cari'])) {
	$history = cariHistory($_POST['keyword']);
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>History Page</title>
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<link rel="stylesheet" type="text/css" href="../css/history.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" href="edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" style="color: #60ef65;" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" href="kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" style="color: #60ef65;" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>History</h1><br>
	</header>


	<div class="content">

		<form action="" method="post">

			<input class="search" type="text" name="keyword" size="40" placeholder="Masukan Nomor Transaksi" autocomplete="off">
			<button class="btn" id="cari" type="submit" name="cari">Cari</button>

		</form><br>
		<form action="" method="post">

			<select name="sort" onchange="form.submit()" />
				<option disabled selected>Sort</option>
				<option value="tanggal_waktu DESC">Date Desc</option>
				<option value="tanggal_waktu ASC">Date Asc</option>
				<option value="nama DESC">Kasir Desc</option>
				<option value="nama ASC">Kasir Asc</option>
				<option value="nomor DESC">#Nomor Desc</option>
				<option value="nomor ASC">#Nomor Asc</option>
				<option value="total DESC">Total Desc</option>
				<option value="total ASC">Total Asc</option>
			</select>

		</form><br>

		<a href="../fitur/export_excel.php?sort=<?= $sort; ?>"><button style="background-color: green; border: 1px solid green; color: white; padding: 3px 5px;" onclick="return confirm('Pastikan Sort Benar, History Akan Mengikuti Urutan/Sort Saat Ini!');">Download History [Excel]</button></a>

		<br><br>
		
		<table border="1" cellpadding="10" cellspacing="0">

			<tr style="background-color: rgba(0, 0, 0, 0.9); color: white;">
				<th width="150px;">#Nomor</th>
				<th width="250px;">Tanggal & Waktu</th>
				<th width="200px;">Total</th>
				<th width="150px;">Kasir</th>
				<th>Detail / Download / Delete</th>
			</tr>
			
			<?php foreach ($history as $key => $value): ?>

				
				<tr style="background-color: rgb(248, 248, 255, 0.9);">
					<td><?= $value['nomor']; ?></td>
					<td><?= $value['tanggal_waktu']; ?></td>
					<td align="right">Rp <?= number_format($value['total']); ?></td>
					<td><?= $value['nama']; ?></td>
					<td align="center">
						<button class="btn" id="v"> <a href="../fitur/transaksi_selesai.php?id_transaksi=<?= $value['id_transaksi']; ?>">Detail</a> </button>
						<button class="btn" id="p"> <a href="../fitur/download.php?id_transaksi=<?= $value['id_transaksi']; ?>">Download</a> </button>
						<button class="btn" id="x"> <a href="../fitur/hapus_history.php?id_transaksi=<?= $value['id_transaksi']; ?>" onclick="return confirm('Delete?');">X</a> </button>
					</td>
				</tr>
				
			<?php endforeach ?>

		</table>

	</div>


	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>


</body>
</html>