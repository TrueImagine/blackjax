<?php
	//proses_transaksi.php
	//berfungsi untuk mengolah transaksi yang ada di shopping cart
	session_start();
	include("../includes/connection.php");
	
	//apabila form proses-transaksi di submit, maka masukkan detail transaksi ke database
	if(isset($_POST['deal'])){
		//masukkan transaksi baru ke tabel transaksi(isi tabel:kode transaksi(kode),subtotal,user...
		//...tanggal dan status)
		
		//ambil user
		$user = $_SESSION['reg_user'];
		
		//cari subtotal
		$subtotal = 0;
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$subtotal = $subtotal + ($_SESSION['shop_list'][$i]['harga']*$_SESSION['shop_list'][$i]['jumlah']);
		}
		
		//Ambil tanggal sekarang
		$tanggal = date("Y-m-d");
		
		//Set status menjadi "Waiting" (id = 1101)
		$status = 1101;
		
		//cari kode terakhir, lalu tambah 1
		$query = "SELECT kode FROM transaksi ORDER BY kode DESC LIMIT 1";
		$kode_transaksi = mysqli_fetch_assoc(mysqli_query($connection,$query));
		if(empty($kode_transaksi)){
			$kode_transaksi['kode'] = 401;
		}
		else{
			$kode_transaksi['kode']  += 1;
		}
		
		//insert ke tabel transaksi
		$query = "INSERT INTO transaksi (kode,subtotal,user,tanggal,status) VALUES ({$kode_transaksi['kode']},{$subtotal},{$user},'{$tanggal}',{$status})";
		mysqli_query($connection,$query);
		
		//insert ke detail transaksi (h_transaksi), isi tabel(h_kode,id_trans,id_barang,jumlah)
		//cari id_trans terakhir, kemudian...
		$query = "SELECT h_kode FROM h_transaksi ORDER BY h_kode DESC LIMIT 1";
		$h_kode = mysqli_fetch_assoc(mysqli_query($connection,$query));

		//...tambah 1
		if(empty($h_kode)){
			$h_kode['h_kode']= 501;
		}
		else{
			$h_kode['h_kode'] += 1;
		} 
		//setelah itu, lakukan insert detail transaksi
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$id_barang = $_SESSION['shop_list'][$i]['id_barang'];
			$jumlah = $_SESSION['shop_list'][$i]['jumlah'];
			
			$detail = "INSERT INTO h_transaksi(h_kode,id_trans,id_barang,jumlah) VALUES ({$h_kode['h_kode']},{$kode_transaksi['kode']},{$id_barang},{$jumlah})";
			mysqli_query($connection,$detail);
			$query_stok = "SELECT stok FROM barang WHERE id_barang={$id_barang} LIMIT 1";
			$baris_stok = mysqli_fetch_assoc(mysqli_query($connection,$query_stok));
			$stok = $baris_stok['stok']-$jumlah;
			$update = "UPDATE barang SET stok={$stok} WHERE id_barang={$id_barang}";
			mysqli_query($connection,$update);
			$h_kode['h_kode'] += 1;
		}
		
		$_SESSION['message'] = "Transaksi berhasil diproses! Kami akan segera menindak lanjuti pemesanan Anda.";
		$_SESSION['shop_list'] = null;
		header('Location:index.php');
	}//akhir isset($_POST['deal'])
	
	//Jika masuk ke halaman web ini tanpa lewat form di shopping cart, maka lempar ke index
	//Jika tidak, proses
	if(!empty($_POST)){
		//elemen terakhir POST adalah confirm, confirm tidak perlu dilakukan pengecekan
		$j = 0;
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$_SESSION['shop_list'][$i]['nama'] = $_POST['nama'.$j];
			$_SESSION['shop_list'][$i]['harga'] = $_POST['harga'.$j];
			$_SESSION['shop_list'][$i]['jumlah'] = $_POST['jumlah'.$j];
			$j++;
		}
		//ambil id_barang berdasarkan namanya
		for($i = 0;$i < count($_SESSION['shop_list']);$i++){
			$query = "SELECT * FROM barang WHERE nama='".$_SESSION['shop_list'][$i]['nama']."' LIMIT 1";
			$tabel_barang = mysqli_query($connection,$query);
			$baris = mysqli_fetch_assoc($tabel_barang);
			$_SESSION['shop_list'][$i]['id_barang'] = $baris['id_barang'];
		}
	}
	else{
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
			<center><h2>Detail Transaksi</h2></center>
			<p style="text-align:center">Detail pemesanan anda dapat dilihat di tabel dibawah</p>
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
			<a href="shopping_cart.php"><< Kembali ke shopping cart</a>
		</div>
	</body>
</html>
<?php
	mysqli_close($connection);
?>