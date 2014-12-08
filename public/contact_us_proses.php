<!-- contact_us_proses.php -->
<?php
include("../includes/connection.php");

$email=$_POST['email'];
$krisan=$_POST['krisan'];
$tgl=date('y-m-d');
$sql = "INSERT INTO krisan(email, isi, tanggal)
		VALUES('$email', '$krisan', '$tgl')";
$submit=mysqli_query($connection,$sql);


?>