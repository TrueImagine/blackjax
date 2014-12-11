<!--
	klik_toys_cms.php
	Halaman ini digunakan untuk mengatur konten website.
	Bagian yang dapat diatur oleh CMS ini adalah content dari setiap halaman,
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
		<script>
			function deleteContent($id){
				if(confirm("Apakah Anda yakin ingin menghapus konten?"){
					location.href= "kliktoys_cms?del_content="+"$id";
				}
			}
		</script>
	</head>
	<body>
		<?php
			//cetak message disini
			cetakPesan();
			
			//Proses penambahan konten disini
			if(isset($_GET['add'])){
				echo "<h3>Tambah Konten Baru</h3>";
				echo "<form action=\"kliktoys_cms.php?subject={$_GET['subject']}\" method=\"POST\">";
				echo "<label>Judul:</label>";
				echo "<input type=\"text\" name=\"judul\" />";
				echo "<br />";
				echo "<label>Isi</label>";
				echo "<textarea name=\"isi\" placeholder=\"Masukkan isi konten disini\"></textarea>";
				echo "<br />";
				echo "<label>Kelihatan?</label>";
				echo "<input type=\"radio\" name=\"visible\" value=\"1\" />Ya &nbsp;";
				echo "<input type=\"radio\" name=\"visible\" value=\"0\" />Tidak";
				echo "<br />";
				echo "<input type=\"submit\" name=\"tambah\" value=\"Tambah Konten\" />";
				echo "</form>";
				echo "<br />";
				echo "<a href=\"kliktoys_cms.php\">>> Kembali</a>";
			}
			//Masih untuk tambah konten
			else if(isset($_POST['tambah'])){
				if(empty($_POST['judul']) || empty($_POST['isi']) || !isset($_POST['visible'])){
					$_SESSION['message'] = "Form tidak boleh kosong";
					header("Location:kliktoys_cms.php?add=1&subject={$_GET['subject']}");
				}
				else{
					$judul = mysqli_real_escape_string($connection,$_POST['judul']);
					$isi = mysqli_real_escape_string($connection,$_POST['isi']);
					$visible = $_POST['visible'];
					
					$query = "SELECT id FROM text_window ORDER BY id DESC LIMIT 1";
					$content_id = mysqli_fetch_assoc(mysqli_query($connection,$query));
					if(empty($content_id)){
						$content_id = 1001;
					}
					else{
						$content_id = $content_id['id'] + 1;
					}
					
					$query = "INSERT INTO text_window (id,judul,isi,subject,visible) VALUES ({$content_id},'{$judul}','{$isi}',{$_GET['subject']},{$visible})";

					mysqli_query($connection,$query);
					
					$_SESSION['message'] = "Konten berhasil ditambahkan";
					header("Location:kliktoys_cms.php");
				}
			}
			//Jika konten di edit, proses di sini
			else if(isset($_POST['edit'])){
				if(empty($_POST['judul']) || empty($_POST['isi']) || !isset($_POST['visible'])){
					$_SESSION['message'] = "Form tidak boleh kosong";
					header("Location:kliktoys_cms.php?content={$_GET['content']}");
				}
				else{
					$judul = mysqli_real_escape_string($connection,$_POST['judul']);
					$isi = mysqli_real_escape_string($connection,$_POST['isi']);
					$visible = $_POST['visible'];
									
					$query = "UPDATE text_window SET judul='{$judul}', isi='{$isi}', visible='{$visible}' WHERE id={$_GET['content']}";
					mysqli_query($connection,$query);
					
					$_SESSION['message'] = "Konten telah di edit";
					header("Location:kliktoys_cms.php");
				}
			}
			//Masih untuk edit
			else if(isset($_GET['content'])){
				$query = "SELECT * FROM text_window WHERE id={$_GET['content']} LIMIT 1";
				$konten = mysqli_fetch_assoc(mysqli_query($connection,$query));
				
				$judul = $konten['judul'];
				$isi = $konten['isi'];
				$visible = $konten['visible'];
				
				echo "<h3>Edit Konten</h3>";
				echo "<form action=\"kliktoys_cms.php?content={$_GET['content']}\" method=\"POST\">";
				echo "<label>Judul:</label>";
				echo "<input type=\"text\" name=\"judul\" value=\"{$judul}\" />";
				echo "<br />";
				echo "<label>Isi</label>";
				echo "<textarea name=\"isi\" placeholder=\"Masukkan isi konten disini\">{$isi}</textarea>";
				echo "<br />";
				echo "<label>Kelihatan?</label>";
				echo "<input type=\"radio\" name=\"visible\" value=\"1\" ";
				if($visible){
					echo "checked";
				}
				echo "/>Ya &nbsp;";
				echo "<input type=\"radio\" name=\"visible\" value=\"0\" ";
				if(!$visible){
					echo "checked";
				}
				echo "/>Tidak";
				echo "<br />";
				echo "<input type=\"submit\" name=\"edit\" value=\"Edit Konten\" />";
				echo "</form>";
				echo "<br />";
				echo "<a href=\"kliktoys_cms.php\">>> Kembali</a>";
			}
			//Jika konten di delete, proses di sini
			else if(isset($_GET['del_content'])){
				$query = "DELETE FROM text_window WHERE id={$_GET['del_content']}";
				
				mysqli_query($connection,$query);
				$_SESSION['message'] = "Konten telah berhasil dihapus";
				header('Location:kliktoys_cms.php');
			}
			else if(isset($_GET['subject'])){
				$query = "SELECT subject_name FROM subjects WHERE id={$_GET['subject']} LIMIT 1";
				$nama_subject = mysqli_fetch_assoc(mysqli_query($connection,$query));
				
				echo "<h2>";
				echo "Pengaturan: {$nama_subject['subject_name']}";
				echo "</h2>";
				echo "<p>";
				echo "Konten yang ada di halaman ini adalah:";
				echo "</p>";
				$query = "SELECT * FROM text_window WHERE subject={$_GET['subject']}";
				
				$tabel_contents = mysqli_query($connection,$query);
				
				echo "<table>";
				while($content = mysqli_fetch_assoc($tabel_contents)){
					echo "<tr>";
					echo "<td>";
					echo "<a href=\"kliktoys_cms.php?content={$content['id']} \">";
					echo $content['judul'];
					echo "</a>";
					echo "</td>";
					echo "<td>";
					echo "<a onclick=\"return confirm('Apakah Anda yakin ingin menghapus konten ini?');\"
					href=\"kliktoys_cms.php?del_content={$content['id']}\">
					>> Hapus konten
					</a>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<a href=\"kliktoys_cms.php?add=1&subject={$_GET['subject']}\">Add new content</a>";
				echo "<br />";
				echo "<a href=\"kliktoys_cms.php\">>> Kembali</a>";
			}
			else{//Jika tidak ada bagian yang dipilih, maka tampilkan menu utama
		?>
		<p>Silahkan pilih salah satu bagian website yang akan diubah</p>
		<ul>
			<?php
				$query = "SELECT * FROM subjects";
				$tabel_subject = mysqli_query($connection,$query);
				
				while($subject = mysqli_fetch_assoc($tabel_subject)){
					echo "<li>";
					echo "<a href=\"kliktoys_cms.php?subject={$subject['id']}\">";
					echo $subject['subject_name'];
					echo "</a>";
					echo "</li>";
				}
			?>
		</ul>
		<a href="admin.php">>> Kembali ke menu admin</a>
		<?php 
			}//akhir menu utama
		?>
	</body>
	<?php mysqli_close($connection); ?>
</html>