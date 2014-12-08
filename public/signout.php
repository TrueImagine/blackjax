<?php
	//signout.php
	//berfungsi untuk signout reg_user
	
	session_start();
	//jika user telah melakukan login, maka hapus jejak loginnya dan lempar ke index.php
	if($_SESSION['reg_user']){
		$_SESSION['reg_user'] = null;
		//jika ada cookie shopping list, hapus juga
		if(!empty($_COOKIE['shop-list'])){
			$_COOKIE['shop-list'] = null;
		}
	}
	header("Location:index.php");
?>