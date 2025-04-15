<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Daftar Penjualan</h1>
		<a href="penjualantambah.php" class="btn btn-primary float-right">Tambah Penjualan</a>

		<div class="row">
			<div class="col l12">
				<div class="card shadow mb-4">

					<div class="card-body">
						<table class="table table-bordered table-striped" id="table">
							<thead class="bg-primary text-white">
								<tr>
									<th>No</th>
									<th>No. Nota</th>
									<th>Tanggal Penjualan</th>
									<th>Daftar Barang</th>
									<th>Total Belanja</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$nomor = 1;
								$ambil = $koneksi->query("SELECT * FROM penjualan GROUP BY notajual ORDER BY tanggalpenjualan DESC");
								$totalpemasukan = 0;
								while ($pecah = $ambil->fetch_assoc()) { ?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['kodenota'] ?></td>
										<td><?php echo date("d-m-Y", strtotime($pecah['tanggalpenjualan'])) ?></td>
										<td>
											<ul>
												<?php
												$ambildaftarbarang = $koneksi->query("SELECT * FROM penjualan WHERE notajual = '$pecah[notajual]'");
												while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
													<li><?= $daftarbarang['namabarang'] ?> - <?= $daftarbarang['jumlah'] ?> x <?= rupiah($daftarbarang['harga']) ?></li>
												<?php } ?>
											</ul>
										</td>
										<td><?php echo rupiah($pecah['grandtotal']) ?></td>
										<td>
											<a class="btn btn-primary text-white mb-1" href="cetakfaktur.php?id=<?php echo $pecah['notajual']; ?>" target="_blank">Nota</a>
											<br><br>
											<a href="penjualanhapus.php?id=<?php echo $pecah['notajual']; ?>" class="btn btn-danger mb-1" onclick="return confirm('Yakin Mau di Hapus?')">Hapus</a>
										</td>
									</tr>
								<?php
									$totalpemasukan += $pecah['grandtotal'];
									$nomor++;
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="4" class="text-right"><em>Total Pemasukan :</em></th>
									<th><?= rupiah($totalpemasukan) ?></th>
									<th></th>
								</tr>
							</tfoot>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>