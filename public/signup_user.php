<!-- signup_user -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
?>

<html>
<head>
		<title>Kliktoys.com | Your one stop shop to games and toys!</title>
		<link rel="stylesheet" type="text/css" href="style/toystyle.css" />
		<link rel="stylesheet" type="text/css" href="style/productstyle.css" />
</head>
<body>
	<div id="body">
		<?php
		include("../includes/header.php");
		?>
		<?php
		include("../includes/left_wing.php");
		?>
	<div id="main-content">
		<?php cetakPesan(); ?>
		<form action="signup_user_proses.php" method="POST">
		Username:
		<input type="text" name="username" /><br />
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
	</div>
	<p class="clearFloat"></p>
	<div id="footer">
		Copyright <?php echo date("Y"); ?>, www.kliktoys.com
	</div>
	</div>
	
</body>
</html>