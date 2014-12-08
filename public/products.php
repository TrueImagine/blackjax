<!-- index.php -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Kliktoys.com | Your one stop shop to games and toys!</title>
		<link rel="stylesheet" type="text/css" href="style/toystyle.css" />
		<link rel="stylesheet" type="text/css" href="style/productstyle.css" />
	</head>
	<body>
		<!-- div body menandakan container isi (header,content,dsb) dari dokumen web,
			ukuran body membuat web tidak mengambil layar secara penuh -->
		<div id= "body">
			<!-- bagian header dimasukkan ke header.php -->
			<?php include("../includes/header.php");?>
			
			<!-- left_wing berisi search, mini-cart dan link-link ke produk sesuai kategorinya,
				daftar link bisa di edit di bagian kategori barang -->
			<!-- bagian left-wing dimasukkan ke left_wing.php -->
			<?php include("../includes/left_wing.php")?>
			
			<!-- main-content di products berfungsi untuk menampilkan produk -->
			<div id="main-content">
				<h2>Produk</h2>
				<?php
					// Apabila jenis barang belum dipilih, maka tampilkan pesan untuk memilih kategori
					// atau nama produk
					// NB: produk yang dipilih akan selalu memiliki jenis 
					if(empty($_GET["jenis"])){
					?>
					<p>Silahkan pilih kategori atau nama produk</p>
					<form id="form-cari-productsphp" action="products.php" method="GET">
						<label>Nama produk:</label>
						<input type="text" placeholder="Nama produk" name="cari" />
						<br />
						<label>Kategori:</label>
						<select name="jenis">
							<option value="semua">Semua</option>
							<?php
								$query = "SELECT * FROM jenis_barang";
								$tabel_barang= mysqli_query($connection,$query);

								while($baris = mysqli_fetch_assoc($tabel_barang)){
									echo "<option value = \"{$baris["id_jenis"]}\">";
									echo $baris["nama"];
									echo "</option>";
								}
							?>
						</select>
						<br /><br />
						<input type="submit" name="submit" value="Submit" />
					</form>
					<?php
						//akhir if(empty($_GET["jenis"]))
						}
					// Apabila jenis tidak kosong, cek apakah id(barang) sudah dipilih atau ada
					// Jika ada, maka tampilkan produk tersebut
					else if(!empty($_GET['id'])){
						$query = "SELECT * FROM barang WHERE id_barang={$_GET['id']} LIMIT 1";
						$item = mysqli_query($connection,$query);
						
						if($baris = mysqli_fetch_assoc($item)){
							echo "<img src =\"{$item['big_logo']}\" href=\"{$item['big_logo']}\" />";
							echo "<ul>";
							echo "<li>";
							echo "Nama: {$baris{'nama'}}";
							echo "</li>";
							echo "<li>";
							echo "Harga: {$baris{'harga'}}";
							echo "</li>";
							echo "<li>";
							echo "Stok: {$baris{'stok'}}";
							echo "</li>";
							echo "</ul>";
						}
					}
					// Jika tidak ada id(barang), maka pilih semua item yang memiliki jenis tertentu
					else{
						if(is_numeric($_GET['jenis'])){
							$query = "SELECT * FROM jenis_barang WHERE id_jenis={$_GET['jenis']} LIMIT 1";
							$tabel_jenis = mysqli_query($connection,$query);
							if($baris = mysqli_fetch_assoc($tabel_jenis)){
								echo "<h3>Kategori: {$baris['nama']}</h3>";
							}
						}
						else if($_GET['jenis'] == "semua"){
							echo "<h3>Kategori: Semua</h3>";
						}
						barang_berdasarkan_jenis($_GET['jenis']);
					}
				?>
			</div>
			<p class="clearFloat"></p>
			
			<!-- footer menampilkan... -->
			<div id="footer">
				Copyright <?php echo date("Y"); ?>, www.kliktoys.com
			</div>
		</div><!-- end of body -->
		<?php
			//tutup koneksi setelah page selesai di load
			mysqli_close($connection);
		?>
	</body>
</html>