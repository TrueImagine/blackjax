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
		header("Location:products.php?id={$_GET['id']}");
	}
	//Jika sudah login, maka lakukan proses untuk memasukkan barang ke cart
	else{
		//Jika belum ada, maka buat shop-list baru
		if(empty($_SESSION['shop_list'])){
			$baris = barang_menurut_id($_GET['id']);
			$barang = mysqli_fetch_assoc($baris);
			$nama = "shop_list";
			//Jika stok barang tidak ada, penambahan barang batal dan tampilkan pesan
			if($barang['stok'] == 0){
				$_SESSION['message'] = "Stok produk sedang habis. Untuk konfirmasi, silahkan hubungi contact center kami.";
			}
			else{
				$nilai = array(array("nama" => $barang['nama'], "harga" => $barang['harga'], "jumlah" => 1));
			
				$_SESSION[$nama] = $nilai;
				$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
			}
		}
		//Jika shop-list sudah ada, maka perbaharui shop-list
		else{
			$tabel_barang = barang_menurut_id($_GET['id']);
			$barang = mysqli_fetch_assoc($tabel_barang);
			$nilai = $_SESSION['shop_list'];
			//Cek apakah produk sudah ada di cart, jika belum ada, tambah produk baru
			if(cek_produk_di_cart($_GET['id']) == false){
				//Cek apakah stok barang ada, jika tidak ada, penambahan barang batal dan tampilkan pesan
				if($barang['stok'] == 0){
					$_SESSION['message'] = "Stok produk sedang habis. Untuk konfirmasi, silahkan hubungi contact center kami.";
				}
				else{
					$elemen_akhir = count($nilai);
					$nilai[$elemen_akhir]['nama'] = $barang['nama'];
					$nilai[$elemen_akhir]['harga'] = $barang['harga'];
					$nilai[$elemen_akhir]['jumlah'] = 1;
					$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
				}
			}
			//Jika produk sudah ada di cart, tambah jumlahnya
			else{
				$ketemu = false;
				$i = 0;
				while($ketemu == false && $i < count($nilai)){
					if($nilai[$i]['nama'] == $barang['nama']){
						//Jika stok barang ada, maka tambah jumlahnya
						if($barang['stok'] > $nilai[$i]['jumlah']){
							$nilai[$i]['jumlah'] += 1;
							$_SESSION['message'] = "Barang sudah dimasukkan ke shopping cart";
						}
						else{
							$_SESSION['message'] = "Stok produk tidak mencukupi. Untuk konfirmasi, silahkan hubungi contact center kami.";
						}
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