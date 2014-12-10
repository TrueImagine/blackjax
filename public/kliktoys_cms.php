<!--
	klik_toys_cms.php
	Halaman ini digunakan untuk mengatur konten website.
	Bagian yang dapat diatur oleh CMS ini adalah sebagai berikut:
	- Header dari semua halaman
	- Left-wing dari semua halaman
	- Footer dari semua halaman
	- Content dari setiap halaman, bagian ini tergantung dari tipe halaman tersebut
-->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201){
		header("Location:admin.php");
	}
?>
<!DOCTYPE html>
	<head>
		<title>Kliktoys.com | Pengaturan Konten Website</title>
		<link rel="stylesheet" type="text/css" href="toystyle.css" />
	</head>
	<body>
		<?php
			//Jika salah satu bagian web yang akan diatur telah dipilih, maka proses 
			if(isset($_GET['change'])){
				//Cek apakah yang dipilih adalah header
				if($_GET['change' == "header"]){
					echo "<h2>Pengaturan Header</h2>";
					echo "Preview: <br />";
					include("../includes/header.php");
					
				}
			}
			else{//Jika tidak ada bagian yang dipilih, maka tampilkan menu utama
		?>
		<p>Silahkan pilih salah satu bagian website yang akan diubah</p>
		<ul>
			<li><a href="kliktoys_cms.php?change=header">Header</a></li>
			<li><a href="kliktoys_cms.php?change=left-wing">Left-wing</a></li>
			<li><a href="kliktoys_cms.php?change=footer">Footer</a></li>
			<li><a href="kliktoys_cms.php?change=content">Content</a></li>
		</ul>
		<?php 
			}//akhir menu utama
		?>
	</body>
	<?php mysqli_close($connection); ?>
</html>