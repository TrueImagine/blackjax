<?php
	// addcart.php
	// Halaman ini digunakan untuk mengolah pemesanan user dan memasukkannya ke shopping cart
	
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
		//Jika belum ada, maka buat shop-list baru
		if(empty($_SESSION['shop_list'])){
			$baris = barang_menurut_id($_GET['id']);
			$barang = mysqli_fetch_assoc($baris);
			$nama = "shop_list";
			$nilai = array("nama" => array($barang['nama']), "harga" => array($barang['harga']), "jumlah" => array(1));
			
			$_SESSION[$nama] = $nilai;
			$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
		}
		//Jika shop-list sudah ada, maka perbaharui shop-list
		else{
			$tabel_barang = barang_menurut_id($_GET['id']);
			$barang = mysqli_fetch_assoc($tabel_barang);
			$nilai = $_SESSION['shop_list'];
			if(cek_produk_di_cart($_GET['id']) == false){
				$nilai['nama'][count($nilai['nama'])] = $barang['nama'];
				$nilai['harga'][count($nilai['harga'])] = $barang['harga'];
				$nilai['jumlah'][count($nilai['jumlah'])] = 1;
				$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
			}
			else{
				$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
				$ketemu = false;
				$i = 0;
				while($ketemu == false && $i < count($nilai['nama'])){
					if($nilai['nama'][$i] == $barang['nama']){
						$nilai['jumlah'][$i] += 1;
						$ketemu = true;
					}
					$i++;
				}
			}
			$_SESSION['shop_list'] = $nilai;
		}
		header("location:products.php?id={$_GET['id']}");
	}
	mysqli_close($connection);
?>