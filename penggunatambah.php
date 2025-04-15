<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Customer Tambah</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Customer</label>
							<input type="text" name="nama" class="form-control">
						</div>
						<div class="kolominput">
							<label>Email</label>
							<input type="text" name="email" class="form-control">
						</div>
						<div class="kolominput">
							<label>No. Hp</label>
							<input type="number" name="telepon" class="form-control">
						</div>
						<div class="kolominput">
							<label>Alamat</label>
							<textarea rows="5" class="form-control" name="alamat"></textarea>
						</div>
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if (isset($_POST['simpan'])) {
    $koneksi->query("INSERT INTO pengguna
        (nama, email, telepon, alamat, level) 
        VALUES('$_POST[nama]', '$_POST[email]', '$_POST[telepon]', '$_POST[alamat]', 'Customer')");

    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<script>location='penggunadaftar.php';</script>";
}
?>

<?php
include 'footer.php';
?>