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
				<?php cetakPesan(); ?>
				<h2>Produk</h2>
				<?php
					//Bagian content (text-window)
					//Bagian ini hanya akan muncul bila isi database text-window terisi
					$query = "SELECT * FROM text_window WHERE subject = 902 AND visible=1";
					$tabel_konten = mysqli_query($connection,$query);
					
					while($konten = mysqli_fetch_assoc($tabel_konten)){
						echo "<div id=text-window>";
						echo "<h3>{$konten['judul']}</h3>";
						echo "<p>";
						echo $konten['isi'];
						echo "</p>";
						echo "</div>";
					}
				?>
				<?php
					// Apabila jenis barang dan id barang belum dipilih,
					// maka tampilkan form untuk mencari produk
					if(empty($_GET["jenis"]) && empty($_GET['id'])){
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
					// Selanjutnya, cek apakah id(barang) sudah dipilih
					// Jika ada, maka tampilkan produk tersebut
					else if(!empty($_GET['id'])){
						$item = barang_menurut_id($_GET['id']);
						
						if($baris = mysqli_fetch_assoc($item)){
							echo "<img src =\"{$baris['big_logo']}\" href=\"{$baris['big_logo']}\" />";
							echo "<ul id=\"ket_barang\">";
							echo "<li>";
							echo "Nama: {$baris{'nama'}}";
							echo "</li>";
							echo "<li>";
							echo "Harga: Rp.";
							echo number_format($baris['harga'], 2, ',', '.');
							echo "</li>";
							echo "<li>";
							echo "Stok: {$baris{'stok'}}";
							echo "</li>";
							echo "</ul>";
						}
						//button "Add to Cart" dibawah akan membuat produk ditambahkan ke dalam shopping cart,
						//ketentuan dan tata cara tambah item di shopping cart ada di addcart.php
						echo "<button onclick=\"location.href = 'addcart.php?id={$baris['id_barang']}' \">Add to Cart</button>";
						echo "<br /><br />";
						echo "<a href=\"products.php?cari=&jenis={$baris["id_jenis"]}\"><< Kembali ke kategori produk</a>";
					}
					// Jika tidak ada id(barang),
					// maka proses form input search
					else{
						//Jika jenis merupakan jenis tertentu
						if(is_numeric($_GET['jenis'])){
							//ambil barang yang sesuai dengan input keyword nama
							$query = "SELECT * FROM jenis_barang WHERE id_jenis={$_GET['jenis']} LIMIT 1";
							$tabel_jenis = mysqli_query($connection,$query);
							if($baris = mysqli_fetch_assoc($tabel_jenis)){
								echo "<h3>Kategori:</h3>";
								echo "<img src='{$baris['gambar']}'/>";
								echo "</br>";
							}
						}
						//Sebaliknya, jika jenis adalah "semua", maka cetak semua
						else if($_GET['jenis'] == "semua"){
							echo "<h3>Kategori: Semua</h3>";
						}
						barang_berdasarkan_jenis_dan_nama($_GET['jenis'],$_GET['cari']);
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