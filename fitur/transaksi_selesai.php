<?php 

session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$id_transaksi = $_GET['id_transaksi'];

$data1 = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'");
$transaksi = mysqli_fetch_assoc($data1);

$detail = query("SELECT tb_transaksi_detail.*, tb_makanan.nama FROM tb_transaksi_detail INNER JOIN tb_makanan ON tb_transaksi_detail.id=tb_makanan.id WHERE tb_transaksi_detail.id_transaksi = '$id_transaksi'");


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Struk</title>
	<style type="text/css">
		body{
			color: #a7a7a7;
		}
	</style>
</head>
<body>

	<div align="center">
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<th>
					<a href="../page/history.php"><button style=" width: 10%; background-color: #ff0c0c; color: white; border: 1px solid #ff0c0c;"> << </button></a>
					<a href="download.php?id_transaksi=<?= $id_transaksi; ?>"><button style="width: 70%; background-color: green; color: white; border: 1px solid green;">Download</button></a>
				</th>
			</tr>
			<tr>
				<th>Forrst Cafe. <br>
					Jl Roda 24, Babakan Pasar, Bogor <br>
				Jawa Barat</th>
			</tr>
			<tr align="center"><td><hr></td></tr>
			<tr>
				<td>#<?= $transaksi['nomor']; ?> | <?= date('d-m-Y H:i:s', strtotime($transaksi['tanggal_waktu'])); ?> | <?= ucfirst($transaksi['nama']); ?></td>
			</tr>
			<tr><td><hr></td></tr>
			
		</table>
		<table width="500" border="0" cellpadding="3" cellspacing="0">
			
			<?php foreach ($detail as $key => $value): ?>

			<tr>
				<td><?= $value['jumlah']; ?></td>
				<td><?= $value['nama'] ?></td>
				<td align="right"><?= number_format($value['harga']); ?></td>
				<td align="right"><?= number_format($value['total']); ?></td>
			</tr>

			<?php endforeach ?>
			

			<tr><td colspan="4"><hr></td></tr>
			<tr>
				<td align="right" colspan="3">Total</td>
				<td align="right"><?= number_format($transaksi['total']); ?></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Bayar</td>
				<td align="right"><?= number_format($transaksi['bayar']); ?></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Kembali</td>
				<td align="right"><?= number_format($transaksi['kembali']); ?></td>
			</tr>

		</table>
		<table width="500" border="0" cellspacing="0" cellpadding="1">
			<tr><td><hr></td></tr>
			<tr>
				<th>Terimakasih, Selamat Menikmati Pesanan Anda</th>
			</tr>
			<tr>
				<th>========== Pesan Antar ==========</th>
			</tr>
			<tr>
				<th>WA/CALL 089517392715</th>
			</tr>
		</table>
	</div>


</body>
</html>