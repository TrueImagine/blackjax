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
				<?php cetakPesan(); ?>
				
				<h1>Edit Profile: </h1>
	<?php cetakPesan(); ?>
	
	<?php
		//Ambil data user yang Ada di database lalu tampilkan
		$query = "SELECT * FROM reg_user WHERE id={$_SESSION['reg_user']} LIMIT 1";
		
		$userdata = mysqli_fetch_assoc(mysqli_query($connection,$query));
		
		$alamat = $userdata['alamat'];
		$email = $userdata['email'];
		$telp = $userdata['telepon'];
	?>
	<form id = "edit_profile" action="edit_user_profile_proses.php" method="POST" >
		<label>Password:</label>
		<input type="password" name="password" /><br />
		<label>Re-Type Password:</label>
		<input type="password" name="repassword" /><br />
		<label>Email:</label>
		<input type="text" name="email" placeholder="example@e-mail.com" value="<?php echo $email; ?>" /><br />
		<label>Alamat:</label>
		<input type="text" name="alamat" value="<?php echo $alamat; ?>" /><br />
		<label>No Telp:</label>
		<input type="text" name="telp" value="<?php echo $telp; ?>" /><br />
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