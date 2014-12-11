<!-- login.php -->
<?php
	session_start();
	include("../includes/functions.php");
?>
<!DOCTYPE html>
	<head>
		<title>Kliktoys.com | Admin</title>
		<link rel="stylesheet" type="text/css" href="style/admin.css" />
	</head>
	<body>
		<div id="body">
			<h2>Kliktoys.com: Admin</h2>
			<?php cetakPesan(); ?>
			<!-- form login berisi username dan password untuk login -->
			<!-- hasil input from akan diproses di login_admin_proses.php -->
			<form action="login_admin_proses.php" method="POST">
				Username:
				<input type="text" name="username" /><br />
				Password:
				<input type="password" name="password" /><br />
				<input type="submit" name="login" value="Login" />
			</form>
			<!-- End untuk form -->
		</div>
	</body>
</html>
		