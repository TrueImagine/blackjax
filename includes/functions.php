<?php
	include("../includes/connection.php");
	
	function boxBarang($barang){
		if(!empty($barang)){
			$output = "<div id = \"produk\">";
			$output .= "<a href = \"products.php?jenis={$barang["id_jenis"]}&id={$barang["id_barang"]}\">";
			$output .= "<img src=\"{$barang["sml_logo"]}\" ";
			$output .= "href = \"products.php?jenis={$barang["id_jenis"]}&id={$barang["id_barang"]}\"";
			$output .= " />";
			$output .= "</a>";
			$output .= "<br />";
			$output .= "<a href = \"products.php?jenis={$barang["id_jenis"]}&id={$barang["id_barang"]}\">";
			$output .= "<p>";
			$output .= $barang["nama"];
			$output .= "</p>";
			$output .= "</a>";
			$output .= "</div>";
		}
		return $output;
	}
	
	function barang_berdasarkan_jenis_dan_nama($jenis,$nama){
		global $connection;
		
		//jika jenis yang dipilih = "semua", maka ambil semua produk
		if($jenis == "semua"){
			$query = "SELECT * FROM barang";
			$tabel_barang = mysqli_query($connection,$query);
		}
		//jika tidak, maka ambil produk berdasarkan jenis tertentu
		else if(is_numeric($jenis)){
			$query = "SELECT * FROM barang WHERE id_jenis={$jenis}";
			$tabel_barang = mysqli_query($connection,$query);
		}
		
		//selanjutnya, cek input keyword dari user
		//jika input keyword user tidak kosong, maka cetak barang yang mengandung keyword
		if(!empty($nama) && $nama != ""){
			while($baris = mysqli_fetch_assoc($tabel_barang)){
				$nama_barang_di_database = strtolower($baris['nama']);
				$keyword_barang = strtolower(urldecode($nama));
				if (strpos($nama_barang_di_database,$keyword_barang) !== false) {
					echo boxBarang($baris);
				}
			}
		}
		//jika tidak, maka cetak semua barang berdasarkan jenisnya
		else{
			while($baris = mysqli_fetch_assoc($tabel_barang)){
				echo boxBarang($baris);
			}
		}
		mysqli_free_result($tabel_barang);
	}
	
	function barang_menurut_id($id){
		global $connection;
		$query = "SELECT * FROM barang WHERE id_barang ={$id}"; 
		$item = mysqli_query($connection,$query);
		return $item;
	}
	
	function cek_produk_di_cart($id){
		$obj = barang_menurut_id($id);
		$barang = mysqli_fetch_assoc($obj);
		$shopcart = $_SESSION['shop_list'];
		$return = false;
		$i = 0;
		while($return == false && $i < count($shopcart['nama'])){
			if($barang['nama'] == $shopcart['nama'][$i]){
				$return = true;
			}
			$i++;
		}
		return $return;
	}
?>