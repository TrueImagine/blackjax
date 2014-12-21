<?php
	//update_status_pesan.php
	//digunakan untuk melakukan update terhadap status pesan melalui kliktoys_trans.php
	
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	//Jika masuk tanpa melalui form pada kliktoys_trans, maka lempar ke admin.php
	if(empty($_POST['edit_pesan'])){
		header("Location:admin.php");
	}
	//Jika tidak, proses
	else{
		//ambil variabel yang dibutuhkan
		$kode = $_POST['kode_trans'];
		$status = $_POST['status'];
		
		//lakukan update
		$query = "UPDATE transaksi SET status={$status} WHERE kode={$kode}";
		mysqli_query($connection,$query);
		
		$_SESSION['message'] = "Status transaksi telah berhasil di-update";
		header("Location:kliktoys_trans.php");
	}
	
?>