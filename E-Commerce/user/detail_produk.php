<?php
	error_reporting(0);
	include '../koneksi/db.php';
	$kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE user_id = 1");
	$a = mysqli_fetch_object($kontak); 

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'");
	$p = mysqli_fetch_object($produk);
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
			<h1><a href="index_user.php">E-Commerce</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="keluar.php"><input type="submit" name="submit" value="Keluar" class="btn"></a></li>
			</ul>
		</div>
	</header>
	<!--search-->

	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- detail produk-->

	<div class="section">
		<div class="container">
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="../produk/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format ($p->product_price) ?></h4>
					<p>Deskripsi: <br>
						<?php echo $p->product_description ?>
					</p>
					<p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->user_telp ?>&text=Hai, saya tertarik dengan produk Anda. <?php echo $p->product_name ?> Rp. <?php echo number_format ($p->product_price) ?> " target="_blank">Hubungin Via Whatsapp 
					<img src="../img/wa.png" width="50px"></a>
					</p>
				</div>
				
			</div>
		</div>
	</div>

<?php include '../footer.php'; ?>
</body>	
</html>