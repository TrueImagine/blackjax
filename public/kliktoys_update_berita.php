<?php
	session_start();
	include("../includes/connection.php");
	
	if(empty($_SESSION['id_admin'])){
		header('Location:login_admin.php');
	}
?>
	<h3>Isi berita</h3>
	<h4>Peringatan!</h4>
	<p>
		Mengubah konten berita akan mempengaruhi konten berita di halaman lain!
	</p>
	<?php
		$query = "SELECT * FROM news";
		$tabel_berita = mysqli_query($connection,$query);
					
		echo "<table>";
		echo "<tr>";
		echo "<th>";
		echo "Tanggal";
		echo "</th>";
		echo "<th>";
		echo "Isi berita";
		echo "</th>";
		echo "<th>";
		echo "Ubah";
		echo "</th>";
		echo "</tr>";
		while($berita = mysqli_fetch_assoc($tabel_berita)){
			echo "<tr>";
			echo "<td>";
			echo $berita['tanggal'];
			echo "</td>";
			echo "<td>";
			echo $berita['isi'];
			echo "</td>";
			echo "<td>";
			echo "<a href=\"kliktoys_cms_berita.php?id_news={$berita['id_news']}\">";
			echo "Ubah";
			echo "</a>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<form action=\"kliktoys_cms_berita.php\">";
		echo "<input type=\"submit\" name =\"add_berita\" value=\"Tambah Berita\" />";
		echo "</form>";
		echo "<a href=\"admin.php\">>> Kembali ke menu admin</a>"
	?>
<?php
	mysqli_close($connection);
?>