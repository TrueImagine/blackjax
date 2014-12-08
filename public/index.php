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
	</head>
	<body>
		<!-- div body menandakan container isi (header,content,dsb) dari dokumen web,
			ukuran body membuat web tidak mengambil layar secara penuh -->
		<div id= "body">
			<!-- header berisi banner(gambar) dan top navigation(navi) -->
			<div id="header">
				<img src="" placeholder="Kliktoys Banner" />
				
				<!-- navigation bar -->
				<ul id="navi">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Browse Products</a></li>
					<li><a href="about_us.php">About us</a></li>
					<li><a href="about_us.php">Contact us</a></li>
				</ul>
			</div><!-- end of header -->
			
			<!-- left_wing berisi search, mini-cart dan link-link ke produk sesuai kategorinya,
				daftar link bisa di edit di bagian kategori barang -->
			<div id="left-wing">
				<!-- search container berisi bagian-bagian search -->
				<div id="search-container">
					<h3>Cari produk:</h3>
					<!-- form cari akan melempar hasil input form ke search.php
						disana akan dilakukan pengolahan lebih lanjut terhadap hasil input -->
					<form id = "form-cari" action="search.php" method="GET">
						<label>Nama produk:</label>
						<input type="text" placeholder="Nama produk" name="cari" />
						<label>Kategori:</label>
						<br />
						<select name="kategori">
							<option value="*">All</option>
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
						<br />
						<input type="submit" name="submit" value="Submit" />
					</form>
				</div><!-- end of search container -->
			
				<!-- mini cart merupakan versi kecil dari shopping cart user,
					mini-cart hanya berisi nama barang, jumlah dan total harga saja.
					NB: shopping cart hanya muncul apabila user telah login -->
				<?php
					//if(!empty($_SESSION['login'])){
				?>
					<div id="mini-cart">
						<h3>Mini cart:</h3>
						<table id="mini-cart">
							<tr>
								<th>Qty</th>
								<th>Produk</th>
							<tr>
							<?php
								if(empty($_COOKIE['shop_list'])){
									echo "<tr><td></td></tr>";
								}
								else{
									//Cetak shop-list berdasarkan cookie
								}
							?>
							<tr>
								<th>Total:</th>
								<td><?php ?></td>
							</tr>
						</table>
						<button id="pesan" onclick="location.href = 'transaksi.php';">Pesan</button>
					</div>
				<?php
					//}
				?>
				<div id="kategori">
					<h3>Kategori barang:</h3>
					<ul id="category-list">
						<li><a href="products.php?jenis=601">SH Figuarts</a></li>
						<li><a href="products.php?jenis=602">SIC</a></li>
						<li><a href="products.php?jenis=603">SCM</a></li>
						<li><a href="products.php?jenis=604">Nendoroid</a></li>
					</ul>
				</div>
			</div><!-- end of left-wing -->
			
			<!-- main-content menampilkan news dan lini produk terbaru -->
			<div id="main-content">
				<!-- bagian news, isi news bisa ditambah, edit, dan delete di database -->
				<div id="news">
					<h2>Latest news</h2>
					<?php
						$query = "SELECT * FROM news LIMIT 3";
						$tabel_berita = mysqli_query($connection,$query);
						
						while($baris = mysqli_fetch_assoc($tabel_berita)){
							echo "<h4>";
							echo $baris['tanggal'];
							echo "</h4>";
							echo "<p>";
							echo $baris['isi'];
							echo "</p>";
						}
					?>
				</div><!-- end of news -->
				
				<!-- bagian product-line menampilkan beberapa produk. Jumlah produk yang ditampilkan
				dan aturannya tergantung dari rules php -->
				<div id="product-line">
					<h2>Product terbaru</h2>
					<!-- cetak berdasarkan rules php -->
					<?php
						$query = "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 5";
						$tabel_barang_terbaru = mysqli_query($connection,$query);
						
						while($baris = mysqli_fetch_assoc($tabel_barang_terbaru)){
							echo boxBarang($baris);
						}
					?>
				</div>
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