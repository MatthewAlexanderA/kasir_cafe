<?php 

$conn = mysqli_connect("localhost", "root", "", "db_projek");


function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}



function tambah($data){
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);

	$gambar = upload();
	if ( !$gambar ) {
		return false;
	}

	$query = "INSERT INTO tb_makanan
				VALUES
				('', '$gambar', '$nama', '$harga')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}



function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek gambar yg di upload
	if ( $error === 4 ) {
		echo "<script>
				alert('Pilih Gambar Terlebih Dahulu!')
			  </script>";
		return false;
	}

	// cek apakah yang di upload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode(".", $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('Yang Anda Upload Bukan Gambar!');
			  </script>";
		return false;
	}

	// cek jika ukuran terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran Gambar Terlalu Besar!');
			  </script>";
		return false;
	}

	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

	return $namaFileBaru;

}



function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_makanan WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function delete($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_user WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function historyDelete($id_transaksi){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_transaksi = $id_transaksi");
	mysqli_query($conn, "DELETE FROM tb_transaksi_detail WHERE id_transaksi = $id_transaksi");
	return mysqli_affected_rows($conn);
}




function ubah($data){
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	}
	else{
		$gambar = upload();
	}


	$query = "UPDATE tb_makanan SET
				gambar = '$gambar',
				nama = '$nama',
				harga = '$harga'
			  WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit($data){
	global $conn;

	$id = $data["id"];
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);


	$query = "UPDATE tb_user SET
				username = '$username',
				password = '$password'
			  WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function cari($keyword) {
	$query = "SELECT * FROM tb_makanan 
				WHERE
				nama LIKE '%$keyword%'
			";
	return query($query);
}
function cariHistory($keyword) {
	$query = "SELECT * FROM tb_transaksi 
				WHERE
				nomor LIKE '%$keyword%'
				ORDER BY nomor ASC
			";
	return query($query);
}



function registrasi($data){
	global $conn;

	$username = strtolower(stripcslashes($data['username']));
	$password = mysqli_real_escape_string($conn, $data['password']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);

	//cek username sudah ada atau blm
	$result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Username Sudah Terdaftar!');
			 </script>";
			 return false;
	}

	//cek konfirmasi pass
	if ($password !== $password2) {
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai!');
			 </script>";
			 return false;
	}


	//tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$username', '$password', 2)");

	return mysqli_affected_rows($conn);


}





 ?>