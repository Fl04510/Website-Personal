<?php
	error_reporting(0);
	include 'koneksi/db.php';
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
			<h1><a href="index.php">E-Commerce</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="daftar.php"><input type="submit" name="submit" value="Daftar" class="btn"></a></li>
				<li><a href="login.php"><input type="submit" name="submit" value="Login" class="btn"></a></li>
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


	<!-- new produk-->
	<div class="section">
		<div class="container">
			<h3>Produk </h3>
			<div class="box">
				<?php
					if ($_GET['search'] != '' || $_GET['kat'] != '') {
						$where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
					}
					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC ");
					if (mysqli_num_rows($produk) > 0) {
						while($p = mysqli_fetch_array($produk)) {
					   
				?>
					<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="produk/<?php echo $p['product_image'] ?>">
							<p class="nama"><?php echo $p['product_name'] ?></p>
							<p class="harga">Rp <?php echo number_format ($p['product_price']) ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk Tidak Ada</p>
				<?php } ?>
			</div>
		</div>
	</div>
</body>	
<?php include 'footer.php'; ?>
</html>