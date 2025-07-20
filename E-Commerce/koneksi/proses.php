<?php
require 'db.php';
$nama = $_POST['nama'];
$username= $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
$telp = $_POST['telp'];
$email = $_POST['email'];
$address = $_POST['address'];
$level = $_POST['level'];
$escape_username =mysqli_real_escape_string($koneksi, $username);
$escape_password =mysqli_real_escape_string($koneksi, $password);
$login = mysqli_query($koneksi,"select * from user where username='$escape_username' and password='$escape_password'");
$cek = mysqli_num_rows($login);
// memasukan data ke tabel
$query_sql = "INSERT INTO tb_user (nama_pengguna, username, password, user_telp, user_email, user_address, level) VALUES ('$nama', '$username', '$password', '$telp', '$email', '$address', '$level')";

if (mysqli_query($conn, $query_sql)) {
    header("location: ../user/index_user.php");
} else {
    echo "pendaftaran Gagal :".mysqli_error($conn);
}

?>