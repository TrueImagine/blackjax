<?php
	//kliktoys_trans.php
	//halaman ini berfungsi untuk melakukan pengaturan terhadap transaksi
	
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	//jika belum login (id_admin = kosong), maka lempar ke login form
	if(empty($_SESSION['id_admin'])){
		header('Location:login_admin.php');
	}
	
?>
<!DOCTYPE html>
	<head>
		<title>Kliktoys.com | Admin</title>
		<link rel="stylesheet" type="text/css" href="style/admin.css" />
	</head>
	<body>
		<div id="body">
			<h2>Pengaturan Transaksi</h2>
			<!-- tampilan transaksi dalam tabel -->
			<?php
				//cetak pesan disini
				cetakPesan();
			?>
			
			<?php
				//Jika detail transaksi tidak/belum dilihat, maka tampilkan semua transaksi dalam tabel
				//Jika user melihat detail transaksi, maka $_GET['kode'] akan ada isinya
				if(empty($_GET['kode'])){
			?>
			
			<!-- Bagian tampilan semua transaksi -->
			<table>
				<tr>
					<th>Kode Transaksi</th>
					<th>Tanggal</th>
					<th>Subtotal</th>
					<th>User</th>
					<th>Status</th>
				</tr>
				<?php
					//Ambil semua transaksi, simpan dalam variabel
					$query = "SELECT * FROM transaksi";
					$tabel_trans = mysqli_query($connection,$query);
					
					while($baris = mysqli_fetch_assoc($tabel_trans)){
						//form digunakan untuk update status pesan
						//update pesan dilakukan di update_status_pesan.php
						echo "<form method=\"POST\" action=\"update_status_pesan.php\">";
						
						echo "<tr>";
						echo "<td>";
						
						//setiap bagian transaksi dapat diklik untuk melihat detail transaksinya
						echo "<a href=\"kliktoys_trans.php?kode={$baris['kode']}\">";
						echo $baris['kode'];
						echo "</a>";
						
						echo "</td>";
						echo "<td>";
						echo "<a href=\"kliktoys_trans.php?kode={$baris['kode']}\">";
						echo $baris['tanggal'];
						echo "</a>";
						echo "</td>";
						$query = "SELECT nama FROM reg_user WHERE id={$baris['user']}";
						$user = mysqli_fetch_assoc(mysqli_query($connection,$query));
						echo "<td>";
						echo "<a href=\"kliktoys_trans.php?kode={$baris['kode']}\">";
						echo "Rp".number_format($baris['subtotal'],2,",",".");
						echo "</a>";
						echo "</td>";							
						echo "<td>";
						echo "<a href=\"kliktoys_trans.php?kode={$baris['kode']}\">";
						echo $user['nama'];
						echo "</a>";
						echo "</td>";
						echo "<td>";
						
						//pilihan status sesuai dengan tabel status_pesan di database
						$query = "SELECT * FROM status_pesan";
						$tabel_status = mysqli_query($connection,$query);
						echo "<select name=\"status\">";
						while($rows = mysqli_fetch_assoc($tabel_status)){
							echo "<option value=\"{$rows['id']}\" ";
							
							//buat status transaksi sekarang menjadi yang di-select pada combobox
							if($rows['id'] == $baris['status']){
								echo "selected";
							}
							
							echo ">";
							echo $rows['status'];
							echo "</option>";
						}
						echo "</select>";
						
						echo "</td>";
						echo "<td>";
						
						//Input type = hidden digunakan untuk menyimpan kode transaksi yang akan di-update
						echo "<input type=\"hidden\" name=\"kode_trans\" value=\"{$baris['kode']}\" />";
						
						echo "<input type=\"submit\" name=\"edit_pesan\" value=\"Update Status\" ";
						echo "onclick=\"return confirm('Apakah Anda yakin ingin melakukan update status pemesanan?');\" />";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
					}
				?>
			</table>
			<a href="admin.php"><< Kembali ke menu utama</a>
			<!-- Akhir bagian tampilan semua transaksi -->
			<?php 
				}
				//akhir dari if(empty($_GET['kode']))
				
				//Jika user ingin melihat detail transaksi ($_GET['kode'] ada isinya), maka tampilkan
				else{
			?>
			<!-- Bagian tampilan detail transaksi -->
			<h3>Detail Transaksi</h3>
			<label style="font-weight:bold;">Kode transaksi:</label><label><?php echo $_GET['kode']; ?></label>
			<table>
				<tr>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Harga/pcs</th>
				<th>Jumlah</th>
				<th>Total</th>
				</tr>
				<?php
					$query = "SELECT * FROM h_transaksi ";
					$query .= "INNER JOIN barang ON h_transaksi.id_barang = barang.id_barang ";
					$query .= "WHERE id_trans={$_GET['kode']} ORDER BY h_transaksi.id_barang ASC";

					$barang = mysqli_query($connection,$query);
					
					$subtotal = 0;
					while($baris = mysqli_fetch_assoc($barang)){
						echo "<tr>";
						echo "<td>";
						echo $baris['id_barang'];
						echo "</td>";
						echo "<td>";
						echo $baris['nama'];
						echo "</td>";
						echo "<td>";
						echo "Rp".number_format($baris['harga'],2,",",".");
						echo "</td>";
						echo "<td>";
						echo $baris['jumlah'];
						echo "</td>";
						$total = $baris['harga']*$baris['jumlah'];
						echo "<td>";
						echo "Rp".number_format($total,2,",",".");
						echo "</td>";
						echo "</tr>";
						$subtotal = $subtotal + $total;
					}
				?>
			</table>
			<p style="font-weight:bold;">Subtotal = 
			<?php echo "Rp".number_format($subtotal,2,",",".");?>
			</p>
			<a href="kliktoys_trans.php"><< Kembali</a>
			<!-- Akhir bagian tampilan detail transaksi -->
			<?php
				}
			?>
		</div>
	</body>
	<?php mysqli_close($connection); ?>
</html>