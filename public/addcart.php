<?php
	// addcart.php
	// Halaman ini digunakan untuk mengolah pemesanan user dan memasukkannya ke shopping cart
	// sementara (di cookie)
	
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	
	//Jika id tidak ada di get (mungkin karena mengubah url), maka lempar ke index.php
	if(empty($_GET['id'])){
		header("Location:index.php");
	}
	
	//Jika user belum login, simpan pesan dan lempar ke products.php
	if(empty($_SESSION["reg_user"])){
		$_SESSION['message'] = "Anda harus login terlebih dahulu";
		header("Location:products.php?{$_GET['id']}");
	}
	//Jika sudah login, maka lakukan proses untuk memasukkan barang ke cart
	else{
		//Jika belum ada, maka buat cookie baru
		if(empty($_COOKIE['shop_list'])){
			$barang = barang_menurut_id($_GET['id']);
			$nama = "shop_list";
			$nilai = array("nama" => array($barang['nama']), "harga" => array($barang['harga']), array("jumlah" => 1));
			$expire = time() + 60;
			setcookie($nama,$nilai,$expire);
			$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
		}
		//Jika cookie sudah ada (sudah ada barang di shopping list), maka perbaharui cookie
		else{
			$barang = barang_menurut_id($_GET('id'));
			$nama = "shop_list";
			$nilai = $_COOKIE['shop_list'];
			if(cek_produk_di_cart($_GET['id']) == false){
				$nilai['nama'][count($nilai['nama'])] = $barang['nama'];
				$nilai['harga'][count($nilai['nama'])] = $barang['nama'];
				$nilai['jumlah'][count($nilai['nama'])] = $barang['jumlah'];
				$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
			}
			else{
				$_SESSION['message'] = "Barang sudah ada di shopping cart";
			}
			$expire = time() + 60;
			setcookie($nama,$nilai,$expire);
			header("location:products.php?id={$_GET['id']}");
		}
	}
	mysqli_close($connection);
?>