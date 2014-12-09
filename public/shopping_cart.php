<!-- shopping_cart.php -->
<!-- halaman ini digunakan untuk menampilkan shopping cart user dan menindak lanjutinya ke transaksi -->
<!-- hasil dari konfirmasi transaksi adalah data transaksi akan dimasukkan ke database -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if(isset($_GET['del'])){
		$ketemu = false;
		$i = 0;
		
		while($ketemu == false && $i < count($_SESSION['shop_list'])){
			if($_SESSION['shop_list'][$i]['nama'] == $_GET['del']){
				unset($_SESSION['shop_list'][$i]);
				$_SESSION['shop_list'] = array_values($_SESSION['shop_list']);
				$ketemu = true;
			}
			$i++;
		}
		$_SESSION['message'] = "Pemesanan telah dihapus";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Kliktoys.com | Your one stop shop to games and toys!</title>
		<link rel="stylesheet" type="text/css" href="style/toystyle.css" />
		<link rel="stylesheet" type="text/css" href="style/productstyle.css" />
		<script type="text/javascript">
			function delete_rows($nama){
				if(confirm("Apakah Anda yakin ingin membatalkan pesanan "+$nama+" ?")){
					location.href = "shopping_cart.php?del="+$nama;
				}
			}
		</script>
	</head>
	<body>
		<!-- div body menandakan container isi (header,content,dsb) dari dokumen web,
			ukuran body membuat web tidak mengambil layar secara penuh -->
		<div id= "body">
			
			<!-- header berisi banner(gambar) dan top navigation(navi) -->
			<!-- bagian header dimasukkan ke header.php -->
			<?php include("../includes/header.php");?>
			
			
			<!-- main-content disini menampilkan isi shopping cart -->
			<div id="main-content">
				<h2>Shopping Cart</h2>
				<!-- Jika ada message di session, tampilkan pesan -->
				<!-- container untuk pesan ada di pesan.php -->
				<?php include("../includes/pesan.php"); ?>
				<!-- bagian news, isi news bisa ditambah, edit, dan delete di database -->
				
				<!-- Container untuk cart -->
				<div id="shopping-cart">
					<!-- form untuk mengolah input transaksi, hasil submit form akan dibawa ke
						proses_transaksi.php -->
					<form action="proses_transaksi.php" method="GET">
						<table>
							<tr>
								<th>Nama Produk</th>
								<th>Banyaknya</th>
								<th>Harga Satuan</th>
								<th>Hapus pesanan</th>
							</tr>
							<?php
								//Jika shop-list kosong, maka buat baris kosong dan tampilkan pesan
								if(empty($_SESSION['shop_list'])){
									echo "<tr><td></td><td></td><td></td><td></td><td></td></tr>";
									$message = "Shopping cart Anda masih kosong!";
								}
								//Jika shop-list sudah ada, maka tampilkan barang-barangnya beserta
								//aturan untuk mengubah pesanannya
								else{
									$i = 0;
									foreach($_SESSION['shop_list'] as $baris){
										$query = "SELECT * FROM barang WHERE nama ='";
										$query .= "{$baris['nama']}' LIMIT 1";
										$tabel_barang = mysqli_query($connection,$query);
										$barang = mysqli_fetch_assoc($tabel_barang);
										$total_harga_barang = $baris['harga']*$baris['jumlah'];
										echo "<tr>";
										echo "<td>";
										echo "<input type=\"text\" value=\"{$baris['nama']}\" name=\"nama{$i}\" readonly />";
										echo "</td>";
										echo "<td>";
										echo "<input type= \"number\" value =\"{$baris['jumlah']}\" min=\"1\" max=\"{$barang['stok']}\" name= \"jumlah{$i}\" />";
										echo "</td>";
										echo "<td>";
										echo "<input type=\"text\" value=\"{$baris['harga']}\" name=\"harga{$i}\" readonly />";
										echo "</td>";
										echo "<td>";
										echo "<input type=\"button\" onclick=\"delete_rows('$baris[nama]');\" value=\"Delete\" \>";
										echo "</td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
						</table>
						<?php
							//Jika shop-list ada, maka tampilkan tombol submit
							if(!empty($_SESSION["shop_list"])){
								echo "<input type=\"submit\" name=\"confirm\" value=\"Konfirmasi Pesanan\" />";
							}
						?>
					</form>
				</div>
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