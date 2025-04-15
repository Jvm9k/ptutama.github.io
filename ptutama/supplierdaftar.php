<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Daftar Supplier</h1>
		<a href="suppliertambah.php" class="btn btn-primary float-right">Tambah Data</a>

		<div class="row">
			<div class="col l12">
				<div class="card shadow mb-4">

					<div class="card-body">
						<table class="table table-bordered table-striped" id="table">
							<thead class="bg-primary text-white">
								<tr>
									<th>No</th>
									<th>Nama Supplier</th>
									<th>No. Hp</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomor = 1; ?>
								<?php $ambil = $koneksi->query("SELECT*FROM supplier "); ?>
								<?php while ($pecah = $ambil->fetch_assoc()) { ?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah['namasupplier'] ?></td>
										<td><?php echo $pecah['nohp'] ?></td>
										<td><?php echo $pecah['alamat'] ?></td>
										<td>
											<a href="supplieredit.php?id=<?php echo $pecah['idsupplier']; ?>" class="btn btn-warning">Ubah</a>
											<br><br>
											<a href="supplierhapus.php?id=<?php echo $pecah['idsupplier']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">Hapus</a>
										</td>

									</tr>
									<?php $nomor++; ?>
								<?php } ?>
							</tbody>
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