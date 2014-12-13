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
				
				<h1>Edit Profile: </h1>
	<?php cetakPesan(); ?>
	<form id = "edit_profile" action="edit_user_profile_proses.php" method="POST" >
		Password:
		<input type="password" name="password" /><br />
		Re-Type Password:
		<input type="password" name="repassword" /><br />
		Email:
		<input type="text" name="email" /><br />
		Alamat:
		<input type="text" name="alamat" /><br />
		No Telp:
		<input type="text" name="telp" /><br />
		<input type="submit" name="EDIT" value="EDIT" />
	</form>
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