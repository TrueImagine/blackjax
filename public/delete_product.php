<!-- delete_product.php -->

<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>

<?php
	$sql="DELETE from barang WHERE id_barang='".$_GET['id_barang']."'";
	$hasil=mysqli_query($connection,$sql);
	header('Location:kliktoys_product.php');
?>