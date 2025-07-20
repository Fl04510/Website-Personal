<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'E-Commerce';

	$conn = mysqli_connect($hostname, $username, $password, $dbname) or die('Gagal terhubung ke database');
?>