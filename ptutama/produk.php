<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Produk Kami</h1>
		<div class="row">
			<div class="col l12">
				<?php $ambil = $koneksi->query("SELECT *FROM produk"); ?>
				<?php while ($produk = $ambil->fetch_assoc()) { ?>
					<div class="kontainer">
						<img src="foto/<?php echo $produk['fotoproduk'] ?>" style="width:100%;height:600px;object-fit: cover;">
						<h3><?php echo $produk['namaproduk'] ?></h3>
						<h5>Rp <?php echo number_format($produk['hargaproduk']) ?></h5>
					</div>
					<br>
					<br>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>