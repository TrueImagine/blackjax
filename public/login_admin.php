<!-- login.php -->
<?php
	session_start();
	include("../includes/functions.php");
	
	cetakPesan();
?>
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