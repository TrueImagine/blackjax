<!-- header berisi banner(gambar) dan top navigation(navi) -->
<div id="header">
	<img src="" placeholder="Kliktoys Banner" />
	<div id="user-login">
	<?php
		//jika belum login, maka tampilkan form login, form login dimasukkan dalam form_login.php
		//login ditandai dengan $_SESSION['user']
		if(empty($_SESSION['reg_user'])){
			include("../includes/form_login.php");
		}
		//Jika sudah login, maka tampilkan pesan dan link Sign Out
		else{
			echo "<p>Kamu login sebagai: <span>{$_SESSION['reg_user']}</span></p>";
			echo "<a href=\"edit_user.php\">Edit Profile</a>";
			echo "<br>";
			echo "<a href=\"signout.php\">Sign out</a>";
		}
	?>
	</div>
	<!-- navigation bar -->
	<ul id="navi">
		<li><a href="index.php">Home</a></li>
		<li><a href="products.php">Browse Products</a></li>
		<li><a href="about_us.php">About us</a></li>
		<li><a href="contact_us.php">Contact us</a></li>
	</ul>
	<p class="clearFloat"></p>
</div><!-- end of header -->