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
	<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

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
			<h3>Tambah Data Produk</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-controol" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while ($r = mysqli_fetch_array($kategori)) {  

						?>
						<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="nama" class="input-controll" placeholder="Nama Produk"required>
					<input type="text" name="harga" class="input-controll" placeholder="Harga " required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-controll" name="deskripsi" placeholder="Deskripsi"></textarea><br>
					<select class="input-controol" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
					if (isset($_POST['submit'])) {

						//print_r($_FILES['gambar']);
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];


						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk'.time().'.'.$type2;

						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

						if (!in_array($type2, $tipe_diizinkan)) {
							echo '<script>alert("Format file tidak diizinkan")</script>';
						}else{

							move_uploaded_file($tmp_name, './../produk/'.$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
										null,
										'".$kategori."',
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null
											) ");
							if ($insert) {
								echo '<script>alert("Tambah Data Berhasil")</script>';
								echo '<script>window.location="data-produk.php"</script>';
							}else{
								echo 'gagal'.mysqli_error($conn);
							}
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
	    <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>

</body>
</html>