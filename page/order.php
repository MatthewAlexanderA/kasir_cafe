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

$sum = 0;
if (isset($_SESSION['cart'])) {
	foreach ($_SESSION['cart'] as $key => $value) {
		$sum += $value['harga'] * $value['total'];
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<link rel="stylesheet" type="text/css" href="../css/order.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div class="bar">
	<?php if ( $role == 1 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="edit-menu" href="edit_menu.php"><img class="edit-menu" src="../img/icon/edit.png"> Edit Menu</a> | 
		<a class="order" style="color: #60ef65;" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="regis" href="kasir.php"><img class="regis" src="../img/icon/regis.png"> Registrasi Kasir</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } else if ( $role == 2 ) { ?>
		<a class="home" href="../index.php"><img class="home" src="../img/icon/home.png"> Home</a> | 
		<a class="order" style="color: #60ef65;" href="order.php"><img class="order" src="../img/icon/order.png"> Order</a> | 
		<a class="history" href="history.php"><img class="history" src="../img/icon/history.png"> History</a> | 
		<a class="logout" href="logout.php" onclick="return confirm('Logout?');"><img class="logout" src="../img/icon/logout.png"> Logout</a>
	<?php } ?>
	</div>

	<header>
		<h1>Order Pesanan</h1><br>
	</header>


	<div class="content">
	<div class="pesan">

		<button class="btn" id="reset">
			<a href="../fitur/reset.php" onclick="return confirm('Reset Cart?');">Reset</a>
		</button>

		<form method="post" action="../fitur/ubah_keranjang.php">
		<table border="1" cellpadding="10" cellspacing="0">
		
			<tr style="background-color: rgba(0, 0, 0, 0.9); color: white;">
				<th width="300px;">Nama</th>
				<th width="250px;">Harga</th>
				<th width="50px;">Jumlah</th>
				<th width="250px;">Sub Total</th>
				<th><button class="x1"><b>X</b></button></th>
			</tr>

			<?php if (isset($_SESSION['cart'])): ?>

				<?php foreach ($_SESSION['cart'] as $key => $value) : ?>
					<tr style="background-color: rgba(255, 255, 255, 0.9);">
						<td><?= $value['nama']; ?></td>
						<td style="text-align: right;">Rp <?= number_format($value['harga']); ?></td>
						<td><input style="width: 70px;" type="number" name="total[]" value="<?= $value['total']; ?>" onchange="form.submit()" /></td>
						<td style="text-align: right;">Rp <?= number_format($value['total'] * $value['harga']); ?></td>
						<td><div class="x"><a href="../fitur/hapus_keranjang.php?id=<?=$value['id'];?>" onclick="return confirm('Delete Menu?');"><b>X</b></a></div></td>
					</tr>
				<?php endforeach; ?>
				
			<?php endif ?>
			<?php if (!isset($_SESSION['cart'])) : ?>
				<tr style="background-color: rgba(255, 255, 255, 0.9); text-align: center;"><th colspan="5">Belum Ada Pesanan</th></tr>			
			<?php endif ?>

			<tr style="background-color: rgba(0, 0, 128, 0.9); color: white;">
				<th colspan="2">Total</th>
				<th colspan="3">Rp <?= number_format($sum); ?></th>
			</tr>

			</form>

			<form method="post" action="../fitur/transaksi.php">
				<input type="hidden" name="total" value="<?= $sum; ?>">
				<tr style="background-color: rgba(155, 155, 155, 0.9); color: white;">
					<th colspan="2"><label>Membayar</label></th>
					<th colspan="3">
						Rp <input style="width: 220px;" type="number" name="bayar" id="bayar" autocomplete="off" required>

						<button style="padding: 3px; " class="btn, edit" type="submit">Selesai</button>
					</th>
				</tr>
			</form>

		</table>

	</div>

	<br>

	<form action="" method="post">
		
		<input class="search" type="text" name="keyword" size="40" placeholder="Masukan Nama Menu" autocomplete="off">
		<button class="btn" id="cari" type="submit" name="cari">Cari</button>

	</form>
	<br>

	<form method="post">

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
						<p>Rp <?= number_format($row["harga"]); ?></p>
						<div class="btn"><p><button class="edit" type="submit" name="beli">
							<a href="../fitur/keranjang.php?id=<?= $row["id"]; ?>">Beli</a>
						</button></p></div>

					</div>
				</div>


			<?php endforeach; ?>

		</div>
	</center>
	</div>
	</form>

	<footer>
		<p>Forrst Cafe &copy 2021</p>
	</footer>

</body>
</html>