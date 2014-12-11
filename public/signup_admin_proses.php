<!-- signup_user_proses.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>
<?php
	$sql="SELECT * from admin WHERE nama = '$_POST[username]'";
	$hasil=mysqli_query($connection,$sql);
	$baris=mysqli_fetch_assoc($hasil);
	if($baris['nama']){
	$_SESSION['message']="ID SUDAH ADA";
	header('Location:signup_admin.php');
	}
	else{
	if($_POST['password']==$_POST['repassword']){
	$sql="SELECT id from admin ORDER BY id DESC limit 1";
	$query=mysqli_query($connection,$sql);
	$id=mysqli_fetch_assoc($query);
	$newid = $id['id']+1;

	
	$username=$_POST['username'];
	$kode_kewenangan=$_POST['kewenangan'];
	$password=$_POST['password'];
	$format = "$2y$10$";
	$hash = "JaxJaxJaxJaxJaxJax2222";
	$salt = $format.$hash;
	$newpass = crypt($password,$salt);

	$sql = "INSERT INTO admin(id, nama, enc_pass, kode_kewenangan)
		VALUES('$newid', '$username', '$newpass', '$kode_kewenangan')";
	$daftar=mysqli_query($connection,$sql);
	$_SESSION['message']="ID BERHASIL DIBUAT";
	header('Location:signup_admin.php');
	}
	else{
		$_SESSION['message']="Password anda berbeda";
		header('Location:signup_admin.php');
	}
}	


?>
