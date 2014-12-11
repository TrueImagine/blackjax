<!-- edit_admin_proses.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>

<?php
	$kewenangan=$_POST['kewenangan'];
	
	$sql2="UPDATE admin SET kode_kewenangan=$kewenangan WHERE id=".$_GET['id']."";
	$hasil2=mysqli_query($connection,$sql2);
	//die($kewenangan);
	$_SESSION['message']="ADMIN BERHASIL ID UPDATE!";
	header('location:kliktoys_manage_adm.php');
?>