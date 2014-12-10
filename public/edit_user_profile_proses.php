<!-- edit_user_profile_proses.php -->
 <?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
 ?>
<?php
	if($_POST['password']==$_POST['repassword']){
		$password=$_POST['password'];
		$format = "$2y$10$";
		$hash = "JaxJaxJaxJaxJaxJax2222";
		$salt = $format.$hash;
		$newpass = crypt($password,$salt);
		$update="UPDATE reg_user SET enc_pass='$newpass' ,alamat='$_POST[alamat]' ,email='$_POST[email]' ,telepon='$_POST[telp]' WHERE id='$_SESSION[reg_user]'";
		$query=mysqli_query($connection,$update);
		$_SESSION['message']="Profile Berhasil di Update!";
		header('Location:edit_user.php');	
	}
	else{
		$_SESSION['message']="Password Anda Berbeda!";
		header('Location:edit_user.php');	
	}
?>