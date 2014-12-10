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
		if(!empty($_SESSION['reg_user'])){
	?>
		<div id="mini-cart">
			<h3>Mini cart:</h3>
			<table id="mini-cart">
				<tr>
					<th>Qty</th>
					<th>Produk</th>
				<tr>
				<?php
					if(empty($_SESSION['shop_list'])){
						echo "<tr><td></td></tr>";
					}
					else{
						//Cetak shop-list yang ada di session
						for($i = 0;$i < count($_SESSION['shop_list']);$i++){
							echo "<tr>";
							echo "<td>";
							echo $_SESSION['shop_list'][$i]['jumlah'];
							echo "</td>";
							echo "<td>";
							echo $_SESSION['shop_list'][$i]['nama'];
							echo "</td>";
							echo "</tr>";
						}
					}
				?>
				<!-- baris terakhir untuk total belanja -->
				<tr>
					<th>Total:</th>
					<td>
					<?php
						//Jika shop-list sudah terisi, cetak
						if(!empty($_SESSION['shop_list'])){
							$shopcart = $_SESSION['shop_list'];
							$total = 0;
							for($i = 0;$i < count($shopcart);$i++){
								$total = $total + ($shopcart[$i]['harga'] * $shopcart[$i]['jumlah']);
							}
							echo "Rp".number_format($total,2,",",".");
						}
					?>
					</td>
				</tr>
			</table>
			<button id="pesan" onclick="location.href = 'shopping_cart.php';">Lihat Pesanan</button>
		</div>
	<?php
		}//akhir dari if(!empty($_SESSION['reg_user']))
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
						echo "<li><a href=\"products.php?cari=&jenis={$baris['id_jenis']}\">";
						echo "<img src='{$baris['gambar']}'/>";
						echo "</a>";
						echo "</li>";
					}
				}
			?>
		</ul>
	</div>
</div><!-- end of left-wing -->