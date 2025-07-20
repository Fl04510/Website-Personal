<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #C70039;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #C70039;
        }
    </style>
</head>
<body >
	<div class="container">
		<h2>Login</h2>
		<form action="" method="POST">
			<div class="form-group">
                <input type="text" name="user" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="Password" required>
            </div>
			<div class="form-group">
				<input type="submit" name="submit" value="Login" >
			</div>
			
		</form>
		<?php 
			if (isset($_POST['submit'])) {
				session_start();
				include 'koneksi/db.php';

				$user = mysqli_real_escape_string($conn, $_POST['user']) ;
				$pass = mysqli_real_escape_string($conn, $_POST['pass']) ;

				$cek = mysqli_query($conn, "SELECT * FROM  tb_user WHERE username = '".$user."' AND password = 
					'".MD5($pass)."'");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_object($cek);
					if ($d->level == 'admin') {
						$_SESSION['status_login'] = true;
						$_SESSION['a_global'] = $d;
						$_SESSION['id'] = $d->user_id;

						echo '<script>window.location="admin/dashboard.php"</script>';
					}elseif ($d->level=="pengguna") {
						$_SESSION['status_login'] = true;
						$_SESSION['a_global'] = $d;
						$_SESSION['id'] = $d->user_id;
						echo '<script>window.location="user/index_user.php"</script>';
					}else{
						echo '<script>alert("Username atau Password anda salah !!")</script>';
					}
					
				}else{
					echo '<script>alert("Username atau Password anda salah !!")</script>';
				}
			}

		 ?>
	</div>

</body>
</html>