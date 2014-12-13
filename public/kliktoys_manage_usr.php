<!-- kliktoys_manage_usr.php -->
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
		<h2>Pengaturan User</h2>
		<div id="body">
<?php
	$sql="SELECT * from reg_user";
	$hasil=mysqli_query($connection,$sql);
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>";
	echo "ID";
	echo "</td>";
	echo "<td>";
	echo "NAMA";
	echo "</td>";
	echo "<td>";
	echo "ALAMAT";
	echo "</td>";
	echo "<td>";
	echo "EMAIL";
	echo "</td>";
	echo "<td>";
	echo "NO TELP";
	echo "</td>";
	echo "<td>";
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
		echo "<td>";
		echo $baris['alamat'];
		echo "</td>";
		echo "<td>";
		echo $baris['email'];
		echo "</td>";
		echo "<td>";
		echo $baris['telepon'];
		echo "</td>";
		echo "<td>";
		echo "<form method='POST' action='delete_user_proses.php?id={$baris['id']}'>";
		echo "<input type='submit' name='delete' value='DELETE'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<a href='admin.php'>BACK</a>";
?>
	</div>
	</body>
</html>