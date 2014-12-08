<?php
	function boxBarang($barang){
		if(!empty($barang)){
			$output = "<div id = \"produk\">";
			$output .= "<a href = \"products.php?id={$barang["id_barang"]}\">";
			$output .= "<img src=\"{$barang["sml_logo"]}\" ";
			$output .= "href = \"products.php?id={$barang["id_barang"]}\"";
			$output .= " />";
			$output .= "</a>";
			$output .= "<br />";
			$output .= "<a href = \"products.php?id={$barang["id_barang"]}\">";
			$output .= "<p>";
			$output .= $barang["nama"];
			$output .= "</p>";
			$output .= "</a>";
			$output .= "</div>";
		}
		return $output;
	}
?>