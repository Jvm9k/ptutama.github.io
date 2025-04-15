<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Barang Tambah</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post">
						<div class="kolominput">
							<label>Nama Barang</label>
							<input type="text" name="namaproduk" class="form-control">
						</div>
						<div class="kolominput">
							<label>Stok</label>
							<input type="number" name="stok" class="form-control">
						</div>
						<div class="kolominput">
							<label>Harga Jual</label>
							<input type="number" name="hargajual" class="form-control">
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
	$namaproduk = $_POST["namaproduk"];
	$stok = $_POST["stok"];
	$hargajual = $_POST["hargajual"];
	$koneksi->query("INSERT INTO produk(namaproduk,hargajual,stok)
		VALUES ('$namaproduk','$hargajual','$stok')") or die(mysqli_error($koneksi));
	echo "<script> alert('Produk Sudah Disimpan');</script>";
	echo "<script> location ='produkdaftar.php';</script>";
}


?>
<?php
include 'footer.php';
?>