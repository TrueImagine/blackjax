<!-- kliktoys_product.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
		
?>

<html>
<head>
</head>

<body>
	<?php
		$sql="SELECT * from barang";
		$hasil=mysqli_query($connection,$sql);
		cetakPesan();
		echo "<table border='1'>";
		while($baris = mysqli_fetch_assoc($hasil)){
			echo "<tr>";
			echo "<td>";
			echo $baris['id_barang'];
			echo "</td>";
			//buka form
			echo "<form method='POST' action='edit_product.php?id_barang={$baris['id_barang']}' enctype='multipart/form-data'>";
			echo "<td>";
			echo "<input type='text' name='nama' value='{$baris['nama']}'>";
			echo "</td>";
			echo "<td>";
			echo "<select name='jenis'>";
			$sql2="SELECT * from jenis_barang";
			$hasil2=mysqli_query($connection,$sql2);
			while($baris2=mysqli_fetch_assoc($hasil2)){
				if($baris2['id_jenis'] != $baris['id_jenis']){
					echo "<option value={$baris2['id_jenis']}>{$baris2['nama']}</option>";
				}else{
					echo "<option value={$baris2['id_jenis']} selected>{$baris2['nama']}</option>";
				}
			}
			echo "</select>";
			echo "</td>";
			echo "<td>";
			echo "<input type='number' name='harga' value='{$baris['harga']}'>";
			echo "</td>";
			echo "<td>";
			echo "<input type='number' name='stok' value='{$baris['stok']}'>";
			echo "</td>";
			echo "<td>";
			echo "<input type='text' name='sml_logo' value='{$baris['sml_logo']}'>";
			echo "<input type='file' name='smllogo'/>";
			echo "</td>";
			echo "<td>";
			echo "<input type='submit' name='EDIT' value='EDIT' />";
			echo "</form>";
			//TUTUP FORM
			echo "</td>";
			echo "<td>";
			echo "<form method='POST' action='delete_product.php?id_barang={$baris['id_barang']}'>";
			echo "<input type='submit' name='DELETE' value='DELETE' />";
			echo "</form>";
			echo "</td>";

			echo "</tr>";
		}
		echo "<tr>";
		echo "<form method='POST' action='add_product.php' enctype='multipart/form-data'>";
		echo "<td colspan='2'>";
		echo "<input type='text' name='nama'/>";
		echo "</td>";
		echo "<td>";
		echo "<select name='jenis'>";
		$sql2="SELECT * from jenis_barang";
		$hasil2=mysqli_query($connection,$sql2);
		while($baris2=mysqli_fetch_assoc($hasil2)){
			echo "<option value={$baris2['id_jenis']}>{$baris2['nama']}</option>";
		}
		echo "</select>";
		echo "</td>";
		echo "<td>";
		echo "<input type='number' min=0 name='harga'/>";
		echo "</td>";
		echo "<td>";
		echo "<input type='number' min=0 name='stok'/>";
		echo "</td>";	
		echo "<td>";
		echo "<input type='file' name='sml_logo'/>";
		echo "</td>";
		echo "<td colspan='2'>";
		echo "<input type='submit' name='add' value='add'/>";
		echo "</td>";
		echo "</form>";
		echo "</tr>";
		
		echo "</table>";
		
	?>
</body>

</html>