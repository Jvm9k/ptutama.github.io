<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Daftar Pembelian</h1>
		<a href="pembeliantambah.php" class="btn btn-primary float-right">Tambah Pembelian</a>

		<div class="row">
			<div class="col l12">
				<div class="card shadow mb-4">

					<div class="card-body">
						<table class="table table-bordered table-striped" id="table">
							<thead class="bg-primary text-white">
								<tr>
									<th>No</th>
									<th>No. Nota</th>
									<th>Tanggal Pembelian</th>
									<th>Daftar Barang</th>
									<th>Total Belanja</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php $nomor = 1; ?>
                                        <?php $ambil = $koneksi->query("SELECT*FROM pembelian group by notabeli order by tanggalpembelian desc");
                                        $totalpengeluaran = 0;
                                        ?>
                                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['notabeli'] ?></td>
										<td><?php echo date("d-m-Y", strtotime($pecah['tanggalpembelian'])) ?></td>
										<td>
											<ul>
											<?php
                                                        $ambildaftarbarang = $koneksi->query("SELECT*FROM pembelian where notabeli = '$pecah[notabeli]'");
                                                        while ($daftarbarang = $ambildaftarbarang->fetch_assoc()) { ?>
													<li><?= $daftarbarang['namabarang'] ?> - <?= $daftarbarang['jumlah'] ?> x <?= rupiah($daftarbarang['harga']) ?></li>
												<?php } ?>
											</ul>
										</td>
										<td><?php echo rupiah($pecah['grandtotal']) ?></td>
										<td>
										<a href="pembelianhapus.php?id=<?php echo $pecah['notabeli']; ?>" class="btn btn-danger mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">Hapus</a>

										</td>
									</tr>
								<?php
									$totalpengeluaran += $pecah['grandtotal'];
									$nomor++;
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="4" class="text-right"><em>Total Pengeluaran :</em></th>
									<th><?= rupiah($totalpengeluaran) ?></th>
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