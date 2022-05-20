<?php  
session_start();

if ( !isset($_SESSION['login'])) {
	header("Location: ../login.php");
	exit;
}

require '../functions/functions.php';

$id_transaksi = $_GET["id_transaksi"];

if (historyDelete($id_transaksi) > 0 ) {
	echo "

		<script>
			alert('History Berhasil Dihapus');
			document.location.href = '../page/history.php';
		</script>
	";
}
else{
	echo "

		<script>
			alert('History Gagal Dihapus');
			document.location.href = '../page/history.php';
		</script>
	";
}

?>