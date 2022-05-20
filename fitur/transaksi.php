<?php 

session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$bayar = $_POST['bayar'];
$tanggal_waktu = date('Y-m-d H:i:s');
$nomor = rand(111111,999999);
$total = $_POST['total'];
$nama = $_SESSION['username'];
$kembali = $bayar - $total;

if ($bayar < $total) {
	echo "
		<script>
			alert('Maaf Uang yang Anda Masukan Kurang!');
			document.location.href = '../page/order.php';
		</script>
	";
	exit;
}

// insert ke tb_transaksi
mysqli_query($conn, "INSERT INTO `tb_transaksi`(
	`id_transaksi`, `tanggal_waktu`, `nomor`, `total`, `nama`, `bayar`, `kembali`) VALUES (NULL, '$tanggal_waktu', '$nomor', '$total', '$nama', '$bayar', '$kembali')");

// mendapatkan id_transkasi baru
$id_transaksi = mysqli_insert_id($conn);

// insert ke tb_transaksi_detail
foreach ($_SESSION['cart'] as $key => $value) {
	
	$id = $value['id'];
	$harga = $value['harga'];
	$jumlah = $value['total'];
	$tot = $harga * $jumlah;


	mysqli_query($conn, "INSERT INTO tb_transaksi_detail (
		id_transaksi_detail, id_transaksi, id, harga, jumlah, total) VALUES (NULL, '$id_transaksi', '$id', '$harga', '$jumlah', '$tot')");


}

$_SESSION['cart'] = [];

header("Location: transaksi_selesai.php?id_transaksi=$id_transaksi");



 ?>