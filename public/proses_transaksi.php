<?php
	//proses_transaksi.php
	//berfungsi untuk mengolah transaksi yang ada di shopping cart
	session_start();
	include("../includes/connection.php");
	
	//elemen terakhir POST adalah confirm, confirm tidak perlu dilakukan pengecekan
	$j = 0;
	for($i = 0;$i < count($_SESSION['shop_list']);$i++){
		$_SESSION['shop_list'][$i]['nama'] = $_GET['nama'.$j];
		$_SESSION['shop_list'][$i]['harga'] = $_GET['harga'.$j];
		$_SESSION['shop_list'][$i]['jumlah'] = $_GET['jumlah'.$j];
		$j++;
	}
	//ambil id_barang berdasarkan namanya
	for($i = 0;$i < count($_SESSION['shop_list']);$i++){
		$query = "SELECT * FROM barang WHERE nama='".$_SESSION['shop_list'][$i]['nama']."' LIMIT 1";
		$tabel_barang = mysqli_query($connection,$query);
		$baris = mysqli_fetch_assoc($tabel_barang);
		$_SESSION['shop_list'][$i]['id_barang'] = $baris['id_barang'];
	}
	
	//apabila form proses-transaksi di submit, maka masukkan detail transaksi ke database
	if(isset($_POST['deal'])){
		//masukkan transaksi baru ke tabel transaksi(isi tabel:kode transaksi(kode),subtotal,user)
		$user = $_SESSION['reg_user'];
		$subtotal = 0;
		//cari subtotal
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$subtotal = $subtotal + ($_SESSION['shop_list'][$i]['harga']*$_SESSION['shop_list'][$i]['jumlah'];
		}
		//cari kode terakhir, lalu tambah 1
		$query = "SELECT kode FROM transaksi ORDER BY kode DESC LIMIT 1";
		$kode_transaksi = mysqli_fetch_assoc(mysqli_query($connection,$query));
		$kode_transaksi += 1; 
		//insert ke tabel transaksi
		$query = "INSERT INTO transaksi (kode,subtotal,user) VALUES ({$kode_transaksi},{$subtotal},{$user})";
		mysqli_query($connection,$query);
		
		//insert ke detail transaksi (h_transaksi), isi tabel(id_trans,id_barang,jumlah)
		//cari id_trans terakhir, kemudian...
		$query = "SELECT id_trans FROM h_transaksi ORDER BY id_trans DESC LIMIT 1";
		$id_trans = mysqli_fetch_assoc(mysqli_query($connection,$query));
		//...tambah 1
		$id_trans += 1;
		//setelah itu, lakukan insert detail transaksi
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$id_barang = $_SESSION['shop_list'][$i]['id_barang'];
			$jumlah = $_SESSION['shop_list'][$i]['jumlah'];
			
			$detail = "INSERT INTO h_transaksi(id_trans,id_barang,jumlah_pesan) VALUES ({$id_trans},{$id_barang},{$jumlah})";
			$id_trans += 1;
		}
		$_SESSION['message'] = "Transaksi berhasil diproses! Kami akan segera menindak lanjuti pemesanan Anda.";
		header('Location:index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Proses Transaksi</title>
		<link rel="stylesheet" type="text/css" href="style/transaksi.css" />
	</head>
	<body>
		<div id="transaksi">
			<h2>Detail Transaksi</h2>
			<p>Detail pemesanan anda dapat dilihat di tabel dibawah</p>
			<form action="proses_transaksi.php" method="POST">
				<table>
					<th>ID Barang</th>
					<th>QTY</th>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<?php
						$total = 0;
						for($i = 0;$i < count($_SESSION['shop_list']);$i++){
							echo "<tr>";
							echo "<td style=\"width:70px\">{$_SESSION['shop_list'][$i]['id_barang']}</td>";
							echo "<td style=\"width:30px\">{$_SESSION['shop_list'][$i]['jumlah']}</td>";
							echo "<td style=\"width:120px\">{$_SESSION['shop_list'][$i]['nama']}</td>";
							echo "<td style=\"width:60px\">{$_SESSION['shop_list'][$i]['harga']}</td>";
							echo "<td style=\"width:60px\">";
							$jml_harga = $_SESSION['shop_list'][$i]['harga']*$_SESSION['shop_list'][$i]['jumlah'];
							$total = $total + $jml_harga;
							echo $jml_harga;
							echo "</td>";
							echo "</tr>";
						}
						echo "<tr>";
						echo "<th colspan=\"4\">Total</th>";
						echo "<td>{$total}</td>";
						echo "</tr>";
					?>
				</table>
				
				<div id="submit">
					<p>Klik tombol dibawah untuk mengkonfirmasi pesanan Anda</p>
					<input type="submit" name="deal" value="Lakukan Pemesanan" />
				</div>
			</form>
			<a href="shopping_cart.php">>> Kembali ke shopping cart</a>
		</div>
	</body>
</html>
<?php
	mysqli_close($connection);
?>