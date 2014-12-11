<!-- admin.php -->
<!-- halaman utama untuk admin, disini dapat dilakukan perubahan-perubahan
	terhadap konten web dan database -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if(empty($_SESSION['id_admin'])){
		header('Location:login_admin.php');
	}
	
	$query = "SELECT kewenangan FROM kewenangan WHERE kode={$_SESSION['kewenangan']} LIMIT 1";
	$kewenangan = mysqli_fetch_assoc(mysqli_query($connection,$query));
	$kewenangan = $kewenangan['kewenangan'];
?>
<!DOCTYPE html>
	<head>
		<title>Kliktoys.com | Admin</title>
		<link rel="stylesheet" type="text/css" href="style/admin.css" />
	</head>
	<body>
		<div id="body">
		<h2>Menu Utama</h2>
		<div id="login-info">
			</h2>Selamat Datang!</h2>
			<table>
				<tr>
					<td>Anda login sebagai:</td>
					<td><?php echo $_SESSION['nama_admin']; ?></td>
				</tr>
				<tr>
					<td>Kewenangan Anda:</td>
					<td><?php echo $kewenangan; ?></td>
				</tr>
				<tr>
					<td colspan="2">
						<a href="admin_logout.php">Logout</a>
					</td>
				</tr>
			</table>
		</div>
		<div id="operasi">
			<?php
				//cetak pesan disini
				cetakPesan();
			?>
			<p>
				Silahkan pilih salah satu operasi:
			</p>
			<ul>
				<li>
					<?php
						if(validasiKewenangan($_SESSION['kewenangan'])){
							echo "<a href=\"kliktoys_cms.php\">";
							echo "Pengaturan Konten Website";
							echo "</a>";
						}
						else{
							echo "Pengaturan Konten Website";
						}
					?>
				</li>
				<li><a href="kliktoys_update_berita.php">Pengaturan Berita Terbaru</a></li>
				<li><a href="kliktoys_product.php">Pengaturan Produk</a></li>
				<li>
					<?php
						if(validasiKewenangan($_SESSION['kewenangan'])){
							echo "<a href=\"kliktoys_manage_adm.php\">";
							echo "Pengaturan Admin";
							echo "</a>";
							
						}
						else{
							echo "Pengaturan Admin";
						}
					?>
				</li>
				<li><a href="kliktoys_manage_usr.php">Pengaturan User</a></li>
			</ul>
		</div>
		</div>
	</body>
	<?php mysqli_close($connection); ?>
</html>