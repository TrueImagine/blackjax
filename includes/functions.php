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
	
	function barang_berdasarkan_jenis($jenis){
		global $connection;
		if($jenis == "semua"){
			$query = "SELECT * FROM barang LIMIT 18";
			$tabel_barang = mysqli_query($connection,$query);
		
			while($baris = mysqli_fetch_assoc($tabel_barang)){
				echo boxBarang($baris);
			}
		}
		else if(is_numeric($jenis)){
			$query = "SELECT * FROM barang WHERE id_jenis={$jenis}";
			$tabel_barang = mysqli_query($connection,$query);
			if($baris = mysqli_fetch_assoc($tabel_barang)){
				do{
					echo boxBarang($baris);
				}
				while($baris = mysqli_fetch_assoc($tabel_barang));
			}
			mysqli_free_result($tabel_barang);
		}
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