<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM gudang WHERE idgudang='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Gudang Edit</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Gudang</label>
							<input type="text" name="namagudang" value="<?php echo $pecah['namagudang']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>Deskripsi</label>
							<textarea rows="5" class="form-control" name="deskripsi" ><?php echo $pecah['deskripsi']; ?></textarea>
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
    // Pastikan idgudang dari URL tersedia
    $id = $_GET['id'];
    $namagudang = $_POST['namagudang'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];

    // Perbaiki menjadi UPDATE, bukan INSERT
    $koneksi->query("UPDATE gudang SET 
        namagudang='$namagudang', 
        deskripsi='$deskripsi', 
        alamat='$alamat' 
        WHERE idgudang='$id'");

    echo "<script>alert('Data Berhasil Diperbarui');</script>";
    echo "<script>location='gudangdaftar.php';</script>";
}
?>
<?php
include 'footer.php';
?>