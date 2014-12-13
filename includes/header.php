<!-- header berisi banner(gambar) dan top navigation(navi) -->
<div id="header">
	<img src="image/BANNER.jpg" placeholder="Kliktoys Banner" />
	<div id="user-login">
	<?php
		//jika belum login, maka tampilkan form login, form login dimasukkan dalam form_login.php
		//login ditandai dengan $_SESSION['user']
		if(empty($_SESSION['reg_user'])){
			include("../includes/form_login.php");
		}
		//Jika sudah login, maka tampilkan pesan dan link profil, sign out
		else{
			$query = "SELECT nama FROM reg_user WHERE id={$_SESSION['reg_user']}";
			$nama = mysqli_fetch_assoc(mysqli_query($connection,$query));
			echo "<p>Kamu login sebagai: <span>{$nama['nama']}</span></p>";
			echo "<a href=\"edit_user.php\">Edit Profile</a>";
			echo "<br>";
			echo "<a href=\"signout.php\">Sign out</a>";
		}
	?>
	</div>
	<!-- navigation bar -->
	<ul id="navi">
		<?php
			$query = "SELECT * FROM subjects";
			$tabel_subject = mysqli_query($connection,$query);
			while($baris = mysqli_fetch_assoc($tabel_subject)){
				echo "<li>";
				echo "<a href=\"";
				$nama_page = strtolower($baris['subject_name']);
				$nama_page = str_replace(" ","_",$nama_page);
				echo $nama_page.".php\">";
				echo $baris['subject_name'];
				echo "</a>";
				echo "</li>";
			}
		?>
	</ul>
	<p class="clearFloat"></p>
</div><!-- end of header -->