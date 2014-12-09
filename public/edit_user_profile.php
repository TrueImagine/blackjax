<!-- edit_user_profile.php -->
 <?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
 ?>
<html>

<head>
	<title>Kliktoys.com | Your one stop shop to games and toys!</title>
	<!-- <link rel="stylesheet" type="text/css" href="style/toystyle.css" />
	<link rel="stylesheet" type="text/css" href="style/productstyle.css" /> -->
</head>

<body>
	<h1>EDIT PROFILE: </h1>
	<?php
		$sql="SELECT * from reg_user WHERE nama='$_SESSION[reg_user]'";
		$hasil = mysqli_query($connection, $sql);
		$baris=mysqli_fetch_assoc($hasil);
		echo "username: ";
		echo $baris['nama'];
		echo "<br>";
		echo "<br>";
		echo "email: ";
		echo $baris['email'];
		echo "<br>";
		echo "<br>";
		echo "alamat: ";
		echo $baris['alamat'];
		echo "<br>";
		echo "<br>";
		echo "no telp: ";
		echo $baris['telepon'];
		echo "<br>";
		echo "<br>";
	?>
	<?php include("../includes/pesan.php"); ?>
	<form action="edit_user_profile_proses.php" method="POST" >
		Password:
		<input type="password" name="password" /><br />
		Re-Type Pasword:
		<input type="password" name="repassword" /><br />
		Email:
		<input type="text" name="email" /><br />
		Alamat:
		<input type="text" name="alamat" /><br />
		No Telp:
		<input type="text" name="telp" /><br />
		<input type="submit" name="signup" value="Signup" />
	</form>
</body>

</html>