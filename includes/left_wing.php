<div id="left-wing">
	<!-- search container berisi bagian-bagian search -->
	<div id="search-container">
		<h3>Cari produk:</h3>
		<!-- form cari akan melempar hasil input form ke products.php
			disana akan dilakukan pengolahan lebih lanjut terhadap hasil input -->
		<form id = "form-cari" action="products.php" method="GET">
			<label>Nama produk:</label>
			<input type="text" placeholder="Nama produk" name="cari" />
			<label>Kategori:</label>
			<br />
			<select name="jenis">
				<option value="semua">Semua</option>
				<?php
					//Pilihan selain ALL akan dibaca berdasarkan jumlah kategori(jenis) di database
					$query = "SELECT * FROM jenis_barang";
					$tabel_barang= mysqli_query($connection,$query);

					while($baris = mysqli_fetch_assoc($tabel_barang)){
						echo "<option value = \"{$baris["id_jenis"]}\">";
						echo $baris["nama"];
						echo "</option>";
					}
				?>
			</select>
			<br />
			<input type="submit" name="submit" value="Submit" />
		</form>
	</div><!-- end of search container -->
			
	<!-- mini cart merupakan versi kecil dari shopping cart user,
		mini-cart hanya berisi nama barang, jumlah dan total harga saja.
		NB: shopping cart hanya muncul apabila user telah login -->
	<?php
		//if(!empty($_SESSION['login'])){
	?>
		<div id="mini-cart">
			<h3>Mini cart:</h3>
			<table id="mini-cart">
				<tr>
					<th>Qty</th>
					<th>Produk</th>
				<tr>
				<?php
					if(empty($_COOKIE['shop_list'])){
						echo "<tr><td></td></tr>";
					}
					else{
						//Cetak shop-list berdasarkan cookie
					}
				?>
				<tr>
					<th>Total:</th>
					<td><?php ?></td>
				</tr>
			</table>
			<button id="pesan" onclick="location.href = 'transaksi.php';">Pesan</button>
		</div>
	<?php
		//}
	?>
	<!-- bagian kategori menampilkan kategori-kategori(jenis) barang
		yang dapat di klik untuk merujuk ke barang-barang berkategori tertentu.
		Kategori ditampilkan berdasarkan kategori-kategori yang ada di database-->
	<div id="kategori">
		<h3>Kategori barang:</h3>
		<ul id="category-list">
			<?php
				$query = "SELECT * FROM jenis_barang";
				$tabel_jenis = mysqli_query($connection,$query);
				if(mysqli_num_rows($tabel_jenis) > 0){
					while($baris = mysqli_fetch_assoc($tabel_jenis)){
						echo "<li><a href=\"products.php?jenis={$baris['id_jenis']}\">";
						echo $baris['nama'];
						echo "</a>";
						echo "</li>";
					}
				}
			?>
		</ul>
	</div>
</div><!-- end of left-wing -->