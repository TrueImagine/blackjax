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
				
				<h1>EDIT PROFILE: </h1>
	<?php
		$sql="SELECT * from reg_user WHERE nama='$_SESSION[reg_user]'";
		$hasil = mysqli_query($connection, $sql);
		$baris=mysqli_fetch_assoc($hasil);
		echo "username: ";
		echo $baris['nama'];
		echo "<br>";
		echo "<br>";
		echo "email: ";
		echo $baris['email'];
		echo "<br>";
		echo "<br>";
		echo "alamat: ";
		echo $baris['alamat'];
		echo "<br>";
		echo "<br>";
		echo "no telp: ";
		echo $baris['telepon'];
		echo "<br>";
		echo "<br>";
	?>
	<?php cetakPesan(); ?>
	<form action="edit_user_profile_proses.php" method="POST" >
		Password:
		<input type="password" name="password" /><br />
		Re-Type Pasword:
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