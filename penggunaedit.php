<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Customer Edit</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama pengguna</label>
							<input type="text" name="nama" value="<?php echo $pecah['nama']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>Email</label>
							<input type="email" name="email" value="<?php echo $pecah['email']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>No. Hp</label>
							<input type="number" name="telepon" value="<?php echo $pecah['telepon']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>Alamat</label>
							<textarea rows="5" class="form-control" name="alamat"><?php echo $pecah['alamat']; ?></textarea>
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
    // Pastikan id dari URL tersedia
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // Perbaiki menjadi UPDATE, bukan INSERT
    $koneksi->query("UPDATE pengguna SET 
        nama='$nama', 
        email='$email', 
        telepon='$telepon', 
        alamat='$alamat' 
        WHERE id='$id'");

    echo "<script>alert('Data Berhasil Diperbarui');</script>";
    echo "<script>location='penggunadaftar.php';</script>";
}
?>
<?php
include 'footer.php';
?>