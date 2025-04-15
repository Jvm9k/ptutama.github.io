<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE idproduk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Barang Edit</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Barang</label>
							<input type="text" name="namaproduk" value="<?php echo $pecah['namaproduk']; ?>" class="form-control">
						</div>
						<div class="kolominput">
							<label>Stok</label>
							<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok']; ?>">
						</div>
						<div class="kolominput">
							<label>Harga Jual</label>
							<input type="number" name="hargajual" class="form-control" value="<?php echo $pecah['hargajual']; ?>">
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
	$koneksi->query("UPDATE produk SET namaproduk='$_POST[namaproduk]', stok='$_POST[stok]', hargajual='$_POST[hargajual]' WHERE idproduk='$_GET[id]'") or die(mysqli_error($koneksi));
	echo "<script> alert('Produk Sudah Diupdate');</script>";
	echo "<script> location ='produkdaftar.php';</script>";
}
?>
<?php
include 'footer.php';
?>