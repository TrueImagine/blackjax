<!-- contact_us.php -->
<?php
	session_start();
	include("../includes/connection.php");
?>
<html>
<head>
		<title>Kliktoys.com | Your one stop shop to games and toys!</title>
		<link rel="stylesheet" type="text/css" href="style/toystyle.css" />
		<link rel="stylesheet" type="text/css" href="style/productstyle.css" />
</head>
<body>	
		<form action="contact_us_proses.php" method="POST">
		Email:
		<input type="text" name="email" /><br />
		Kritik dan saran:
		<textarea name="krisan" rows="4"></textarea><br />
		<input type="submit" name="Submit" value="Submit" />
</form>

</body>
</html>