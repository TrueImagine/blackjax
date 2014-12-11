<!-- signup_admin.php -->
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
			<h2>Signup Admin</h2>
<?php
	cetakPesan();
	echo "<form action='signup_admin_proses.php' method='POST'>";
	echo "<label>Username:</label>";
	echo "<input type='text' name='username' /><br />";
	echo "<label>Password:</label>";
	echo "<input type='password' name='password' /><br />";
	echo "<label>Re-Type Password:</label>";
	echo "<input type='password' name='repassword' /><br />";
	echo "<label>Kewenangan:</label>";
	echo "<select name='kewenangan'>";
			$sql="SELECT * from kewenangan";
			$hasil=mysqli_query($connection,$sql);
			while($baris=mysqli_fetch_assoc($hasil)){
				echo "<option value={$baris['kode']}>{$baris['kewenangan']}</option>";
			}
	echo "</select></br>";
	echo "<input type='submit' name='signup' value='Signup' />";
	echo "</form>";
	echo "<a href='kliktoys_manage_adm.php'>BACK</a>";
?>
</div>
	</body>
	<?php mysqli_close($connection); ?>
</html>