<?php
	//kliktoys_cms_berita.php berita konten-konten web
	
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
?>

<?php
	//Proses add berita
	if(isset($_POST['add_berita'])){
		$tanggal = $_POST['tanggal'];
		$isi = $_POST['isi_berita'];
		
		if(empty($isi) || empty($tanggal)){
			$_SESSION['message'] = "Form tidak boleh kosong";
			header('Location:kliktoys_cms_berita.php?add_berita=Tambah Berita');
			die();
		}		
		//cari id_berita terakhir lalu tambah 1
		$query = "SELECT id_news FROM news ORDER BY id_news DESC LIMIT 1";
		$id_berita = mysqli_fetch_assoc(mysqli_query($connection,$query));
		if(empty($id_berita['id_news'])){
			$id_berita = 801;
		}
		else{
			$id_berita = $id_berita['id_news']+1;
		}
		
		$query = "INSERT INTO news (id_news,tanggal,isi) VALUES ({$id_berita},'{$tanggal}','{$isi}')";

		mysqli_query($connection,$query);
		$_SESSION['message'] = "Berita telah ditambahkan!";
		header('Location:admin.php');
	}
	
	//Proses edit berita
	if(isset($_POST['edit_berita'])){
		$isi = $_POST['isi_berita'];
		$id_berita = $_GET['id_berita'];
		
		$query = "UPDATE news SET isi = '{$isi}' WHERE id_news={$id_berita}";

		mysqli_query($connection,$query);
		$_SESSION['message'] = "Update berita telah selesai!";
		header('Location:admin.php');
	}
	
	//Proses delete berita
	if(isset($_GET['del_berita'])){
		$query = "DELETE FROM news WHERE id_news = {$_GET['del_berita']}";
		mysqli_query($connection,$query);
		
		$_SESSION['message'] = "Berita sudah berhasil dihapus";
		header("Location:admin.php");
	}
	
	//Tampilan form edit dan delete berita
	if(isset($_GET['id_news'])){
		$query = "SELECT * FROM news WHERE id_news={$_GET['id_news']}";
		$tabel_berita = mysqli_query($connection,$query);
		$konten_berita = mysqli_fetch_assoc($tabel_berita);
		
		?>
			<h3>Ubah berita</h3>
			<!-- form dibawah berfungsi untuk melakukan edit berita -->
			<form action="kliktoys_cms_berita.php?id_berita=<?php echo $konten_berita['id_news']; ?>" method="POST">
				<label>Tanggal:</label>
				<label><?php echo $konten_berita['tanggal']; ?></label>
				<br />
				<label>Isi berita</label>
				<br />
				<textarea name="isi_berita" placeholder="Isi berita Anda disini"><?php echo $konten_berita['isi']; ?></textarea>
				<br />
				<input type="reset" name="reset" value="Reset" />
				<input type="submit" name="edit_berita" value="Edit Berita" />
			</form>
			<!-- link untuk delete berita -->
			<a onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');"
				href="kliktoys_cms_berita.php?del_berita=<?php echo $konten_berita['id_news']; ?>">
				>> Hapus berita ini
			</a>
		<?php
	}	//akhir dari if(isset($_GET['edit_berita']))
	//Tampilan form untuk tambah berita
	else if(isset($_GET['add_berita'])){
	?>
		<h3>Tambah Berita</h3>
		<!-- form dibawah berfungsi untuk melakukan tambah berita -->
		<form action="kliktoys_cms_berita.php?id_berita=<?php echo $konten_berita['id_news']; ?>" method="POST">
			<label>Tanggal:</label>
			<input type="text" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly />
			<br />
			<label>Isi berita</label>
			<br />
			<textarea name="isi_berita" placeholder="Isi berita Anda disini"></textarea>
			<br />
			<input type="reset" name="reset" value="Reset" />
			<input type="submit" name="add_berita" value="Add Berita" />
		</form>
	<?php
	} //akhir dari if(isset($_GET['add_berita']))
?>