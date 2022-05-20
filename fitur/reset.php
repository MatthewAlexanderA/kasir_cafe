<?php 
session_start();

$_SESSION['cart'] = [];
header("Location: ../page/order.php");

 ?>