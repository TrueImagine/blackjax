<!-- signup_user -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
?>
<!DOCTYPE html>
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
		<h2>Signup User</h2>
		<form id="signup" action="signup_user_proses.php" method="POST">
		<label>Username:</label>
		<input type="text" name="username" /><br />
		<label>Password:</label>
		<input type="password" name="password" /><br />
		<label>Re-Type Password:</label>
		<input type="password" name="repassword" /><br />
		<label>Email:</label>
		<input type="text" name="email" placeholder="example@e-mail.com" /><br />
		<label>Alamat:</label>
		<input type="text" name="alamat" /><br />
		<label>No Telp:</label>
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