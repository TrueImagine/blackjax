<?php
	//proses_transaksi.php
	//berfungsi untuk mengolah transaksi yang ada di shopping cart
	session_start();
	
	//elemen terakhir POST adalah confirm, confirm tidak perlu dilakukan pengecekan
	$j = 0;
	for($i = 0;$i < count($_SESSION['shop_list']);$i++){
		$_SESSION['shop_list'][$i]['nama'] = $_GET['nama'.$j];
		$_SESSION['shop_list'][$i]['harga'] = $_GET['harga'.$j];
		$_SESSION['shop_list'][$i]['jumlah'] = $_GET['jumlah'.$j];
		$j++;
	}
?>