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
				<form action="contact_us_proses.php" method="POST">
				<table>
					<tr>
						<td>
							Email:
						</td>
						<td>
							<input type="text" name="email" /><br />
						</td>
					</tr>
					<tr>
						<td>
							Kritik dan saran:
						</td>
						<td>
							<textarea name="krisan" rows="4"></textarea><br />
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="Submit" value="Submit" />
						</td>
					</tr>
				</table>
				</form>
				
			</div>
			<p class="clearFloat"></p>
			
			<!-- footer menampilkan... -->
			<div id="footer">
				Copyright <?php echo date("Y"); ?>, www.kliktoys.com
			</div>
		</div><!-- end of body -->
		

</body>
</html>