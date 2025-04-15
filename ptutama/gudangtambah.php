<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Gudang Tambah</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Gudang</label>
							<input type="text" name="namagudang" class="form-control">
						</div>
						<div class="kolominput">
							<label>Deskripsi</label>
							<textarea rows="5" class="form-control" name="deskripsi"></textarea>
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
	$koneksi->query("INSERT INTO gudang
		(namagudang, deskripsi,alamat)
		VALUES('$_POST[namagudang]','$_POST[deskripsi]','$_POST[alamat]')");
	echo "<script>alert('Data Berhasil Di Simpan');</script>";
	echo "<script> location ='gudangdaftar.php';</script>";
}
?>
<?php
include 'footer.php';
?>