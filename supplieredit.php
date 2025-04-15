<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM supplier WHERE idsupplier='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Supplier Edit</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Supplier</label>
							<input type="text" name="namasupplier" value="<?php echo $pecah['namasupplier']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>No. Hp</label>
							<input type="number" name="nohp" value="<?php echo $pecah['nohp']; ?>" class="form-control">
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
    // Pastikan idsupplier dari URL tersedia
    $id = $_GET['id'];
    $namasupplier = $_POST['namasupplier'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    // Perbaiki menjadi UPDATE, bukan INSERT
    $koneksi->query("UPDATE supplier SET 
        namasupplier='$namasupplier', 
        nohp='$nohp', 
        alamat='$alamat' 
        WHERE idsupplier='$id'");

    echo "<script>alert('Data Berhasil Diperbarui');</script>";
    echo "<script>location='supplierdaftar.php';</script>";
}
?>
<?php
include 'footer.php';
?>