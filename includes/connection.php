<?php
	$host = "localhost";
	$user = "blackjax";
	$pass = "uas";
	$name = "klik_toys";
	$connection = mysqli_connect($host,$user,$pass,$name);
	
	if(mysqli_connect_errno()){
		die("Database connection error:".mysqli_connect_error()." ".mysqli_connect_errno());
	}
	else{
		echo "Connection success";
	}
?>