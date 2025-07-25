<?php
	error_reporting(0);
	include '../koneksi/db.php';
	$kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE user_id = 1");
	$a = mysqli_fetch_object($kontak);  
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
				<input type="text" name="search" placeholder="Cari Produk">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- category -->
	<div class="section">
		<div class="container">
			<h3>Kategori</h3>
			<div class="box">
				<?php
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if (mysqli_num_rows($kategori) > 0) {
					 	while($k = mysqli_fetch_array($kategori)){ 
				?>
					<a href="produk.php?kat=<?php echo $k['category_id'] ?>">
						<div class="col-5">
							<img src="../img/icon-kategori.png" width="50px" style="margin-bottom: 5px;">
							<p><?php echo $k['category_name'] ?></p>
						</div>
					</a>
			<?php }}else{ ?>
				<p>Kategori Tidak Ada</p>
			<?php } ?>
			</div>
		</div>
	</div>

	<!-- new produk-->
	<div class="section">
		<div class="container">
			<h3>Produk Terbaru</h3>
			<div class="box">
				<?php
					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1  ORDER BY product_id DESC LIMIT 8");
					if (mysqli_num_rows($produk) > 0) {
						while($p = mysqli_fetch_array($produk)) {
					   
				?>
					<a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="../produk/<?php echo $p['product_image'] ?>">
							<p class="nama"><?php echo substr($p['product_name'], 0, 30)  ?></p>
							<p class="harga">Rp <?php echo number_format($p['product_price'])  ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk Tidak Ada</p>
				<?php } ?>
			</div>
		</div>
	</div>
<?php include '../footer.php'; ?>
</body>	
</html>