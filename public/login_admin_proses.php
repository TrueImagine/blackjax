<!--login_admin_proses.php -->
<?php
session_start();
include("../includes/connection.php");

if($_POST['login']){
	$sql= "SELECT * FROM admin WHERE nama = '$_POST[username]'";
	$hasil = mysqli_query($connection, $sql);

	if(mysqli_num_rows($hasil) == 0){
		$_SESSION['message'] = "Username tidak ditemukan";
		header('Location:login_admin.php');
	}

	$baris = mysqli_fetch_assoc($hasil);
	$password = $_POST['password'];

	$format = "$2y$10$";
	$hash = "JaxJaxJaxJaxJaxJax2222";
	$salt = $format.$hash;
	$newpass = crypt($password,$salt);

	if($newpass == $baris['enc_pass']){
		$_SESSION['nama_admin'] = $baris['nama'];
		$_SESSION['id_admin'] = $baris['id'];
		$_SESSION['kewenangan'] = $baris['kode_kewenangan'];
		header('Location:admin.php');
	}
	else{
		$_SESSION['message'] = "Password salah";
		header('Location:login_admin.php');
	}
}
else{
	header('Location:login_admin.php');
}
?>