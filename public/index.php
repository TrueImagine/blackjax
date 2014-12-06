<!-- index.php -->
<?php
	session_start();
	include("../function/connection.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Kliktoys.com | Your one stop shop to games and toys!</title>
		<link rel="stylesheet" type="text/css" href="style/toystyle.css" />
	</head>
	<body>
		<!-- header berisi banner(gambar) dan top navigation(navi) -->
		<div id="header">
			<img src="" placeholder="Kliktoys Banner" />
			
			<!-- navigation bar -->
			<ul id="navi">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Browse Products</li>
				<li><a href="about_us.php">About us</li>
				<li><a href="about_us.php">Contact us</li>
			</ul>
		</div><!-- end of header -->
		
		<!-- left_wing berisi mini-cart dan link-link ke produk sesuai kategorinya,
			daftar link bisa di edit di bagian kategori barang -->
		<div id="left_wing">
			<!-- mini cart merupakan versi kecil dari shopping cart user,
				mini-cart hanya berisi nama barang dan total harga saja.
				NB: shopping cart hanya muncul apabila user telah login -->
			<?php
				if(!empty($_SESSION['login'])){
			?>
				<div id="mini-cart">
					
				</div>
			<?php
				}
			?>
		
			<ul id="category-list">
				<li>SH Figuarts</li>
				<li>SIC</li>
				<li>SCM</li>
				<li>Nendoroid</li>
			</ul>
		</div><!-- end of left-wing -->
		
		<!-- content menampilkan news dan lini produk terbaru -->
		<div id="content">
			<!-- bagian news, isi news bisa ditambah, edit, dan delete di database -->
			<div id="news">
				<h2>Latest news</h2>
				<!-- isi dengan news di database -->
			</div><!-- end of news -->
			
			<!-- bagian product-line menampilkan beberapa produk. Jumlah produk yang ditampilkan
			dan aturannya tergantung dari rules php -->
			<div id="product-line">
				<!-- cetak berdasarkan rules php -->
			</div>
		</div>
		
		<!-- footer menampilkan... -->
		<div id="footer">
			<!-- isi footer pikirin nanti -->
		</div>
	</body>
</html>