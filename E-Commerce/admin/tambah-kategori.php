<?php 
	session_start();
	include '../koneksi/db.php';
	if ($_SESSION['status_login'] != true) {
		echo'<script>window.location="login.php"</script>';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Commerce</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>
<body>
	<header>
		<div class="container">
			<h1><a href="dashboard.php">E-Commerce</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="dashboard.php">Data Kategori</a></li>
				<li><a href="dashboard.php">Data Produk</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Tambah Data Kategori</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
					if (isset($_POST['submit'])) {
					  	
					  	$nama = ucwords($_POST['nama']) ;
					  	$insert = mysqli_query($conn, "INSERT INTO tb_category Values (
					  						null,
					  						'".$nama."')");
					  	if ($insert) {
					  		echo '<script>alert("Data Berhasil Ditambahkan")</script>';
					  		echo '<script>window.location="data-kategori.php"</script>';
					  	}else{
					  		echo 'gagal'.mysqli_error($conn);
					  	}
					  }  
				?>
			</div>

		</div>
	</div>

	<!--Footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - achmadfarrel.</small>
		</div>
	</footer>
</body>
</html>