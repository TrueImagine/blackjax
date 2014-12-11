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
		<link rel="stylesheet" type="text/css" href="style/text_window_style.css" />
	</head>
	<body>
		<!-- div body menandakan container isi (header,content,dsb) dari dokumen web,
			ukuran body membuat web tidak mengambil layar secara penuh -->
		<div id= "body">
			<!-- header berisi banner(gambar) dan top navigation(navi) -->
			<!-- bagian header dimasukkan ke header.php -->
			<?php include("../includes/header.php");?>
			
			<!-- left_wing berisi search, mini-cart dan link-link ke produk sesuai kategorinya,
				daftar link bisa di edit di bagian kategori barang -->
			<!-- bagian left-wing dimasukkan ke left_wing.php -->
			<?php include("../includes/left_wing.php")?>
			
			<!-- main-content menampilkan message, news dan lini produk terbaru -->
			<div id="main-content">
				<!-- Jika ada message di session, tampilkan pesan -->
				<!-- container untuk pesan ada di pesan.php -->
				<?php cetakPesan(); ?>
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
				
				<?php
					//Bagian content (text-window)
					//Bagian ini hanya akan muncul bila isi database text-window terisi
					$query = "SELECT * FROM text_window WHERE subject = 901 AND visible=1";
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
				
				<!-- bagian product-line menampilkan beberapa produk. Jumlah produk yang ditampilkan
				dan aturannya tergantung dari rules php -->
				<div id="product-line">
					<h2>Product terbaru</h2>
					<!-- cetak berdasarkan rules php -->
					<?php
						$query = "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 6";
						$tabel_barang_terbaru = mysqli_query($connection,$query);
						
						while($baris = mysqli_fetch_assoc($tabel_barang_terbaru)){
							echo boxBarang($baris);
						}
					?>
				</div><!-- akhir product-line -->
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