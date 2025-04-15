<?php
session_start();
include 'koneksi.php';
$produk = $koneksi->query("SELECT*FROM produk");
$jumlahproduk = mysqli_num_rows($produk);

$bulanini = date('m');
$pembelian = $koneksi->query("SELECT * FROM pembelian where month(tanggalpembelian) = '$bulanini' group by notabeli");
$totalpembelian = 0;
while ($jumlahpembelian = $pembelian->fetch_assoc()) {
        $totalpembelian += $jumlahpembelian['grandtotal'];
}

$penjualan = $koneksi->query("SELECT * FROM penjualan where month(tanggalpenjualan) = '$bulanini' group by notajual");
$totalpenjualan = 0;
while ($jumlahpenjualan = $penjualan->fetch_assoc()) {
        $totalpenjualan += $jumlahpenjualan['grandtotal'];
}
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer">
	<img src="foto/welcome.jpg" style="width:100%">
</div>
<!-- Card Section -->
<div class="kontainer">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3><?= $jumlahproduk ?></h3>
                    <p>Total Barang</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3><?= rupiah($totalpembelian) ?></h3>
                    <p>Pembelian Bulan Ini</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3><?= rupiah($totalpenjualan) ?></h3>
                    <p>Penjualan Bulan Ini</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>