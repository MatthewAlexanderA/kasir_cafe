<?php 

session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$sort = $_GET['sort'];
$history = query("SELECT * FROM `tb_transaksi` ORDER BY $sort");
$date = date('Y-m-d');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=History" . $date . ".xls");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>

 	<table>
 		
 		<table border="1" cellpadding="10" cellspacing="0">

			<tr>
				<th width="150px;">#Nomor</th>
				<th width="250px;">Tanggal & Waktu</th>
				<th width="200px;">Total</th>
				<th width="150px;">Kasir</th>
			</tr>
			
			<?php foreach ($history as $key => $value): ?>

				
				<tr>
					<td><?= $value['nomor']; ?></td>
					<td><?= $value['tanggal_waktu']; ?></td>
					<td align="right">Rp <?= number_format($value['total']); ?></td>
					<td><?= $value['nama']; ?></td>
				</tr>
				
			<?php endforeach ?>

		</table>

 	</table>
 
 </body>
 </html>