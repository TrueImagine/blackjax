<!-- edit_user.php -->
 <?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
 ?>

<?php
	if(empty($_SESSION['reg_user'])){
		header('Location:index.php');
	}
	else{
		header('Location:edit_user_profile.php');
	}
?>