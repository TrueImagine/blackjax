<!-- kliktoys_manage_adm.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>
<!DOCTYPE html>
	<head>
		<title>Kliktoys.com | Admin</title>
		<link rel="stylesheet" type="text/css" href="style/admin.css" />
	</head>
	<body>
	<div id="body">
	<h2>Pengaturan Admin</h2>
<?php
	$sql="SELECT * from admin";
	$hasil=mysqli_query($connection,$sql);
	cetakPesan();
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>";
	echo "ID";
	echo "</td>";
	echo "<td>";
	echo "NAMA";
	echo "</td>";
	echo "<td>";
	echo "KEWENANGAN";
	echo "</td>";
	echo "</tr>";
	while($baris=mysqli_fetch_assoc($hasil)){
		echo "<tr>";
		echo "<td>";
		echo $baris['id'];
		echo "</td>";
		echo "<td>";
		echo $baris['nama'];
		echo "</td>";
		echo "<form method='POST' action='edit_admin_proses.php?id={$baris['id']}'>";
		echo "<td>";
		echo "<select name='kewenangan'>";
		$sql2="SELECT * from kewenangan";
		$hasil2=mysqli_query($connection,$sql2);
		while($baris2=mysqli_fetch_assoc($hasil2)){
			if($baris2['kode'] != $baris['kode_kewenangan']){
				echo "<option value={$baris2['kode']}>{$baris2['kewenangan']}</option>";
			}else{
				echo "<option value={$baris2['kode']} selected>{$baris2['kewenangan']}</option>";
			}
		}
		echo "</select>";
		echo "</td>";
		echo "<td>";
		echo "<input type='submit' name='EDIT' value='EDIT'>";
		echo "</form>";
		echo "</td>";
		echo "<td>";
		echo "<form method='POST' action='delete_admin_proses.php?id={$baris['id']}'>";
		echo "<input type='submit' name='delete' value='DELETE'>";
		echo "</form>";
		echo "</td>";
		
		echo "</tr>";
	}
	echo "</table>";
	echo "<a href='admin.php'>BACK</a>";
	echo "</br>";
	echo "<a href='signup_admin	.php'>SIGN UP</a>";
?>
	</div>
	</body>
</html>