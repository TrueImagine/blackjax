<!-- about_us.php -->
<!-- contact_us.php -->
<?php
	session_start();
	include("../includes/connection.php");
?>
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
			<!-- main-content menampilkan news dan lini produk terbaru -->
			<div id="main-content">
				<h2>About Us</h2>
				<?php
					//Bagian content (text-window)
					//Bagian ini hanya akan muncul bila isi database text-window terisi
					$query = "SELECT * FROM text_window WHERE subject = 903 AND visible=1";
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
			</div>
			<p class="clearFloat"></p>
			
			<!-- footer menampilkan... -->
			<div id="footer">
				Copyright <?php echo date("Y"); ?>, www.kliktoys.com
			</div>
		</div><!-- end of body -->
		

</body>
</html>