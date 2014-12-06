<!-- signup_user_proses.php -->
<?php
session_start();

include("../includes/connection.php");
$sql="SELECT id from reg_user ORDER BY id DESC limit 1";
$query=mysqli_query($connection,$sql);
$id=mysqli_fetch_assoc($query);
$newid = $id['id']+1;


$username=$_POST['username'];
$password=$_POST['password'];
$format = "$2y$10$";
$hash = "JaxJaxJaxJaxJaxJax2222";
$salt = $format.$hash;
$newpass = crypt($password,$salt);

$sql = "INSERT INTO reg_user(id, nama, enc_pass)
		VALUES('$newid', '$username', '$newpass')";
$daftar=mysqli_query($connection,$sql);

?>