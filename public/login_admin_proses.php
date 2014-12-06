<!--login_proses.php -->
<?php
session_start();

$koneksi =mysqli_connect("localhost", "root", "", "klik_toys");

$sql= "SELECT * FROM admin WHERE nama = '$_POST[username]'";
$hasil = mysqli_query($koneksi, $sql);

if(mysqli_num_rows($hasil) ==0){
	echo "Username tidak ditemukan";
}

$baris = mysqli_fetch_assoc($hasil);
$password =$_POST['password'];
$format = "$2y$10$";
$hash = "JaxJaxJaxJaxJaxJax2222";
$salt = $format.$hash;
$newpass = crypt($password,$salt);
echo $newpass;
if($newpass == $baris['enc_pass']){
	$_SESSION['status']="login";
	header('Location:index.php');
	}
	else{
		echo "Password salah";
	}
?>