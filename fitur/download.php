<?php 

session_start();
// include autoloader
require_once '../library/dompdf/autoload.inc.php';

$id_transaksi = $_GET['id_transaksi'];

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
require 'transaksi_selesai_pdf.php';
$struk = ob_get_clean();
ob_end_clean();

$dompdf->loadHtml($struk);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$fileName = 'Struk #'.$transaksi['nomor'];
$dompdf->render('');

// Output the generated PDF to Browser
$dompdf->stream($fileName);

 ?>