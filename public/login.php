<?php
	// login.php
	// berfungsi untuk mengolah login dari user
	session_start();
	include("../includes/connection.php");
	
	if(!empty($_POST['login'])){
		$user = $_POST['user'];
		$password =$_POST['password'];
		$format = "$2y$10$";
		$hash = "JaxJaxJaxJaxJaxJax2222";
		$salt = $format.$hash;
		$enc_pass = crypt($password,$salt);
		$query = "SELECT * FROM reg_user WHERE nama='{$user}' AND enc_pass='{$enc_pass}' LIMIT 1";
		echo $query;
		$tabel_user = mysqli_query($connection,$query);
		//Jika tabel user ada isinya (user didapatkan), maka login sukses,
		//status login ditandai dengan $_SESSION['user'] 
		if($baris = mysqli_fetch_assoc($tabel_user)){
			$_SESSION['message'] = "Login sukses!";
			$_SESSION['reg_user'] = $baris['id'];
			header('Location:index.php');
		}
		//Jika tidak, simpan pesan gagal, dan lempar ke index.php
		else{
			$_SESSION['message'] = "Username atau password Anda salah";
			header('Location:index.php');
		}
	}
	//apabila masuk tanpa submit, maka lempar ke index.php
	else{
		header('Location:index.php');
	}
	mysqli_close($connection);
?>