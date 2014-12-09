<!-- signup_user_proses.php -->
<?php
session_start();

include("../includes/connection.php");

$nama="SELECT * from reg_user WHERE nama = '$_POST[username]'";
$hasil=mysqli_query($connection,$nama);
$baris=mysqli_fetch_assoc($hasil);
if($baris['nama']){
	$_SESSION['message']="ID SUDAH ADA";
	header('Location:signup_user.php');
}
else{
	if($_POST['password']==$_POST['repassword']){
	$sql="SELECT id from reg_user ORDER BY id DESC limit 1";
	$query=mysqli_query($connection,$sql);
	$id=mysqli_fetch_assoc($query);
	$newid = $id['id']+1;

	
	$username=$_POST['username'];
	$email=$_POST['email'];
	$alamat=$_POST['alamat'];
	$telp=$_POST['telp'];
	$password=$_POST['password'];
	$format = "$2y$10$";
	$hash = "JaxJaxJaxJaxJaxJax2222";
	$salt = $format.$hash;
	$newpass = crypt($password,$salt);

	$sql = "INSERT INTO reg_user(id, nama, enc_pass, email, alamat, telepon)
		VALUES('$newid', '$username', '$newpass', '$email', '$alamat', '$telp')";
	$daftar=mysqli_query($connection,$sql);
	$_SESSION['message']="ID BERHASIL DIBUAT";
	header('Location:index.php');
	}
	else{
		$_SESSION['message']="Password anda berbeda";
		header('Location:signup_user.php');
	}
}	


?>