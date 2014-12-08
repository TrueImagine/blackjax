<?php
	//signout.php
	//berfungsi untuk signout reg_user
	
	session_start();
	//jika user telah melakukan login, maka hapus jejak loginnya dan lempar ke index.php
	if($_SESSION['reg_user']){
		$_SESSION['reg_user'] = null;
		//jika ada shopping list, hapus juga
		if(!empty($_SESSION['shop-list'])){
			$_SESSION['shop-list'] = null;
		}
	}
	header("Location:index.php");
?>