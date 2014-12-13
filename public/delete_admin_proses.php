<!-- delete_admin_proses.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>

<?php
	$sql="DELETE from admin WHERE id='".$_GET['id']."'";
	$hasil=mysqli_query($connection,$sql);
	header('Location:kliktoys_manage_adm.php');
	
?>