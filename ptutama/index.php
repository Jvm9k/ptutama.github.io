<?php
include 'koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
	<link rel="stylesheet" href="login/style.css">
</head>

<body>
	<div class="wrapper">
		<form method="post">
			<h2>Login</h2>
			<div class="input-field">
				<input type="text" name="email" required>
				<label>Email</label>
			</div>
			<div class="input-field">
				<input type="password" name="password" required>
				<label>Password</label>
			</div>
			<br><br>
			<button type="submit" name="simpan" value="Masuk">Log In</button>
		</form>
		<?php
		if (isset($_POST["simpan"])) {
			$email = $_POST["email"];
			$password = $_POST["password"];

			$ambil = $koneksi->query("SELECT * FROM pengguna WHERE email='$email' AND password='$password' LIMIT 1");
			$akunyangcocok = $ambil->num_rows;

			if ($akunyangcocok == 1) {
				$akun = $ambil->fetch_assoc();
				if ($akun['level'] == "Admin") {
					$_SESSION['admin'] = $akun;
					echo "<script> alert('Anda sukses login');</script>";
					echo "<script> location ='beranda.php';</script>";
				} else {
					echo "<script> alert('Akses ditolak! Hanya Admin yang bisa login.');</script>";
					echo "<script> location ='login.php';</script>";
				}
			} else {
				echo "<script> alert('Anda gagal login, cek akun Anda');</script>";
				echo "<script> location ='login.php';</script>";
			}
		}
		?>

	</div>
</body>

</html>