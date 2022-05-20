<?php 
session_start();
require 'functions/functions.php';

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) && isset($_COOKIE['role']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];
	$role = $_COOKIE['role'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM tb_user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}


}

if (isset($_SESSION['login'])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST['login'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

	//cek username
	if ( mysqli_num_rows($result) === 1 ) {
		
		//cek pass
		$row = mysqli_fetch_assoc($result);
		if ($password == $row['password'] ){
			// set session
			$_SESSION['role'] = $row['role'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['login'] = true;

			// cek remember me
			if ( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['id'], time() + 86400);
				setcookie('role', $row['role'], time() + 86400);
				setcookie('key', $row['username'], time() + 86400);
			}

			header("Location: index.php");
			exit;
		}

	}

	$error = true;

}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>

		<form action="" method="post">

		<div class="login-box">
			<h1>Forrst Cafe <span>.</span></h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Username" name="username" id="username" value="" autocomplete="off">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password" name="password" id="password" value="">
			</div>

			<div class="checkbox">
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">Remember Me</label>
			</div>

			<button type="submit" class="btn" name="login">Log in</button>

	</form>
	</div>

	<?php if (isset($error)) : ?>
		<br><br><p style="color: red; font-style: italic; padding: 20px; background-color: #d2abab; width: 250px; border: 3px solid red; margin: 5px;">
			<b>Username / Password Salah!</b></p>
	<?php endif; ?>

</body>
</html>