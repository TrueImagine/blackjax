<!-- delete_userproses.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>
<?php
	$sql="SELECT * from reg_user WHERE id=".$_GET['id'];
	$hasil=mysqli_query($connection,$sql);
	$baris=mysqli_fetch_assoc($hasil);
	$sql2="SELECT * from transaksi WHERE user=".$baris['id'];
	$hasil2=mysqli_query($connection,$sql2);
	$baris2=mysqli_fetch_assoc($hasil2);
	$sql3="SELECT * from h_transaksi WHERE id_trans=".$baris2['kode'];
	$hasil3=mysqli_query($connection,$sql3);
	$baris3=mysqli_fetch_assoc($hasil3);

	$sql4="DELETE from h_transaksi WHERE id_trans=".$baris2['kode'];
	$hasil4=mysqli_query($connection,$sql4);
	$sql5="DELETE from transaksi WHERE user=".$baris['id'];
	$hasil5=mysqli_query($connection,$sql5);
	$sql6="DELETE from reg_user WHERE id=".$_GET['id'];
	$hasil6=mysqli_query($connection,$sql6);
	header('location:kliktoys_manage_usr.php');
	
	
?>