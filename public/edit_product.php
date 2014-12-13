<!-- edit_product -->
<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>
<?php
	$sql="SELECT * from barang WHERE id_barang='".$_GET['id_barang']."'";
	$query=mysqli_query($connection,$sql);
	$baris=mysqli_fetch_assoc($query);
	
	$nama=$_POST['nama'];
	$harga=$_POST['harga'];
	$stok=$_POST['stok'];
	$idjenis=$_POST['jenis'];
	if(empty($_FILES['smllogo']['name'])){
		$tujuan=$baris['sml_logo'];
		$sql2="UPDATE barang SET nama='$nama', id_jenis='$idjenis', harga='$harga', stok='$stok', sml_logo='$tujuan', big_logo='' WHERE id_barang='".$_GET['id_barang']."'";
		$query=mysqli_query($connection,$sql2);
		header('Location:kliktoys_product.php');
		$_SESSION['message']="DATABASE BERHASIL DI UPDATE!";
	}else{
	$file_name=$_FILES['smllogo']['name'];
	$file_size = $_FILES['smllogo']['size'];
	$file_tmp = $_FILES['smllogo']['tmp_name'];
	$file_name = $nama;
	$file_name .= ".";
	$file_name .= $file_ext;
	$sumber = $file_tmp;
	$tujuan = "image/".$file_name;
	$file_ext=strtolower(end(explode(".", $file_name)));
	$ext_boleh=array("jpg","jpeg","gif","bmp","png");
	if(in_array($file_ext, $ext_boleh)){
	if($file_size <= 2*1024*1024){	
	move_uploaded_file($sumber,$tujuan);
	$sql2="UPDATE barang SET nama='$nama', id_jenis='$idjenis', harga='$harga', stok='$stok', sml_logo='$tujuan', big_logo='' WHERE id_barang='".$_GET['id_barang']."'";
	$query=mysqli_query($connection,$sql2);
	header('Location:kliktoys_product.php');
	$_SESSION['message']="DATABASE BERHASIL DI UPDATE!";
	}else{
		$_SESSION['message'] = "FILE MAX 2MB";
		header('Location:kliktoys_product.php');
	}
	}else{
		$_SESSION['message'] = "File hanya boleh gambar ";
		header('Location:kliktoys_product.php');
	}
	}
?>