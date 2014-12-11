<!-- add_product.php -->

<?php
	session_start();
	include("../includes/connection.php");
	include("../includes/functions.php");
	
	if($_SESSION['kewenangan'] != 201 && $_SESSION['kewenangan'] != 202 ){
		header('Location:admin.php');
	}
?>

<?php
	$sql="SELECT * from barang order by id_barang desc limit 1";
	$query=mysqli_query($connection,$sql);
	$baris=mysqli_fetch_assoc($query);
	
	$idbarang=$baris['id_barang']+1;
	$nama=$_POST['nama'];
	$harga=$_POST['harga'];
	$stok=$_POST['stok'];
	$idjenis=$_POST['jenis'];
	$file_name=$_FILES['sml_logo']['name'];
	$file_size = $_FILES['sml_logo']['size'];
	$file_tmp = $_FILES['sml_logo']['tmp_name'];
	$file_ext=strtolower(end(explode(".", $file_name)));
	$ext_boleh=array("jpg","jpeg","gif","bmp","png");
	if(in_array($file_ext, $ext_boleh)){
	if($file_size <= 2*1024*1024){
	
	$file_name = $_POST['nama'];
	$file_name .= ".";
	$file_name .= $file_ext;
	$sumber = $file_tmp;
	$tujuan = "image/".$file_name;
	move_uploaded_file($sumber,$tujuan);
	$sql2="INSERT into barang(id_barang, nama, id_jenis, harga, stok, sml_logo, big_logo)
			VALUES('$idbarang', '$nama', '$idjenis', '$harga', '$stok', '$tujuan', '')";
	$query=mysqli_query($connection,$sql2);
	header('Location:kliktoys_product.php');
	}else{
		$_SESSION['message'] = "FILE MAX 2MB";
		header('Location:kliktoys_product.php');
	}
	}else{
		$_SESSION['message'] = "File hanya boleh gambar ";
		header('Location:kliktoys_product.php');
	}
	
	
?>