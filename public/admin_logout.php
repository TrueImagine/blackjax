<?php
	//admin_logout.php
	//Berfungsi untuk mengolah logout dari admin lalu melemparnya ke login_admin.php
	session_start();
	
	//Jika admin telah melakukan login (ditandai dengan adanya $_SESSION['id_admin'])
	//maka hapus semua jejak loginnya (id_admin,nama_admin dan kewenangan) lalu lempar ke login_admin.php
	if(!empty($_SESSION['id_admin'])){
		$_SESSION['id_admin'] = null;
		$_SESSION['nama_admin'] = null;
		$_SESSION['kewenangan'] = null;
		
		header("Location:login_admin.php");
	}
?>