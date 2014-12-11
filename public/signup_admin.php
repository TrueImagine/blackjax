<!-- signup_admin.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>
<?php
	cetakPesan();
	echo "<form action='signup_admin_proses.php' method='POST'>";
	echo "Username:";
	echo "<input type='text' name='username' /><br />";
	echo "Password:";
	echo "<input type='password' name='password' /><br />";
	echo "Re-Type Pasword:";
	echo "<input type='password' name='repassword' /><br />";
	echo "Kewenangan:";
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