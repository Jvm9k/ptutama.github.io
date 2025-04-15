<?php
session_start();
include 'koneksi.php';
?>

<?php include 'header.php'; ?>
<div class="display-kontainer kontainer" style="padding-bottom: 50px;">
	<div class="kontainer padding-32">
		<h1>Penjualan Tambah</h1>
		<div class="row">
			<div class="col l12">
				<div class="kontainer">
					<form method="post" enctype="multipart/form-data">
						<div class="kolominput">
							<label>Tanggal Penjualan</label>
							<input class="form-control" name="tanggalpenjualan" type="date" required value="<?= date('Y-m-d') ?>" autocomplete="off">
						</div>
<br>
						<table class="table table-bordered table-striped" id="tabelform">
							<tr>
								<td width="30%">
									<div class="kolominput namabarangharga">
										<label>Nama Barang</label>
										<select name="namabarang[]" class="form-control namabarang" required>
											<option value="">Pilih Barang</option>
											<?php $ambil = $koneksi->query("SELECT*FROM produk "); ?>
											<?php while ($pecah = $ambil->fetch_assoc()) { ?>
												<option value="<?= $pecah['namaproduk'] ?>" data-price="<?= $pecah['hargajual'] ?>"><?= $pecah['namaproduk'] ?></option>
											<?php } ?>
										</select>
									</div>
								</td>
								<td>
									<div class="kolominput">
										<label>Harga</label>
										<input type="text" id="harga1" value="0" name="harga[]" oninput="check()" onchange="check()" class="form-control harga" readonly required>
									</div>
								</td>
								<td width="15%">
									<div class="kolominput">
										<label>Jumlah</label>
										<input type="number" value="1" min="0" id="jumlah1" name="jumlah[]" oninput="check()" onchange="check()" class="form-control jumlah" required>
									</div>
								</td>
								<td>
									<div class="kolominput">
										<label>Total</label>
										<input type="text" id="total1" name="total[]" value="0" class="form-control total">
									</div>
								</td>
								<td>
									<div class="kolominput">
										<button type="button" name="add" id="addkegiatan" class="btn btn-primary mt-4">+</button>
									</div>
								</td>
							</tr>
						</table>
						<br>
						<div class="kolominput">
							<label>Grand Total</label>
							<input class="form-control" id="grandtotal" name="grandtotal" type="number">
							<input class="form-control" id="grandtotalnon" name="grandtotalnon" type="hidden" readonly required>
						</div>
						<div class="kolominput">
							<label>Uang Pembeli</label>
							<input class="form-control" id="uangpembeli" name="uangpembeli" type="text" oninput="kembalian()" onchange="kembalian()">
						</div>
						<div class="kolominput">
							<label>Kembalian</label>
							<input class="form-control" id="kembalian" name="kembalian" type="text" value="0" readonly>
						</div>
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'footer.php';
?>
<?php
if (isset($_POST['simpan'])) {
    $tanggalpenjualan = $_POST['tanggalpenjualan'];
    $grandtotal = $_POST['grandtotalnon'];
    $uangpembeli = $_POST['uangpembeli'];
    if ($uangpembeli == "") {
        $uangpembeli = 0;
    } else {
        $uangpembeli = round($uangpembeli, 0);
    }
    $kembalian = $_POST['kembalian'];
    $notajual = date("Ymdhis");
    $i = 0;
    // kodenota
    $gettahun = date('Y', strtotime($tanggalpenjualan));
    $noplus = 1;
    $kodenotapertama = $gettahun . '' . $noplus;
    $ambilkodenota = $koneksi->query("SELECT * FROM penjualan where kodenota = '$kodenotapertama'");
    $cekkodenota = $ambilkodenota->num_rows;
    if ($cekkodenota >= 1) {
        $datakodenota = $ambilkodenota->fetch_assoc();

        $ambilkodenotaterakhir = $koneksi->query("SELECT * FROM penjualan order by idpenjualan desc limit 1");
        $datakodenotaterakhir = $ambilkodenotaterakhir->fetch_assoc();
        $digitterakhir = substr($datakodenotaterakhir['kodenota'], 4);
        $kodenota = $gettahun . '' . ($digitterakhir + 1);
    } else {
        $kodenota = $kodenotapertama;
    }
    foreach ($_POST['namabarang'] as $val) {
        $namabarang = $_POST['namabarang'][$i];
        $harga = $_POST['harga'][$i];
        $jumlah = $_POST['jumlah'][$i];
        $total = $_POST['total'][$i];
        $koneksi->query("INSERT INTO penjualan(notajual,kodenota,namabarang,harga,jumlah,total,tanggalpenjualan,grandtotal,uangpembeli,kembalian)
    	VALUES ('$notajual','$kodenota','$namabarang','$harga','$jumlah','$total','$tanggalpenjualan','$grandtotal','$uangpembeli','$kembalian')") or die(mysqli_error($koneksi));
        $koneksi->query("UPDATE produk SET stok=stok-'$jumlah' WHERE namaproduk='$namabarang'") or die(mysqli_error($koneksi));

        $i++;
    }
    echo "<script> alert('Penjualan Barang Berhasil Disimpan');</script>";
    echo "<script> location ='cetaknota.php?id=$notajual';</script>";
}
?>
<script>
    var $submit = $('#btn_simpan');

    $(document).ready(function() {
        var i = 1;
        $('#addkegiatan').click(function() {

            i++;
            html = "";
            html += '<tr id="row' + i + '">' +
                '<td width="30%">' +
                '<div class="kolominput namabarangharga">' +
                '<label>Nama Barang</label>' +
                '<select name="namabarang[]" class="form-control namabarang" required>' +
                '<option value="">Pilih Barang</option>' +
                '<?php $ambil = $koneksi->query("SELECT*FROM produk "); ?>' +
                '<?php while ($pecah = $ambil->fetch_assoc()) { ?>' +
                '<option value="<?= $pecah['namaproduk'] ?>" data-price="<?= $pecah['hargajual'] ?>"><?= $pecah['namaproduk'] ?></option>' +
                '<?php } ?>' +
                '</select>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="kolominput">' +
                '<label>Harga</label>' +
                '<input type="text" id="harga' + i + '" name="harga[]" value="0" class="form-control harga" oninput="check()" onchange="check()" readonly required>' +
                '</div>' +
                '</td>' +

                '<td width="15%">' +
                '<div class="kolominput">' +
                '<label>Jumlah</label>' +
                '<input type="number" value="1" min="0" id="jumlah' + i + '" name="jumlah[]" class="form-control jumlah" oninput="check()" onchange="check()" required>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="kolominput">' +
                '<label>Total</label>' +
                '<input type="text" id="total' + i + '" name="total[]" class="form-control total" value="0" readonly>' +
                '</div>' +
                '</td>' +

                '<td>' +
                '<div class="kolominput">' +
                '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove mt-4">X</button>' +
                '</div>' +
                '</td>' +


                '</tr>';

            $('#tabelform').append(html);
        });

    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $(document).ready(function() {
        $(".total").each(function() {
            setInterval(hitunggrandtotal, 100);
        });
    });

    function hitunggrandtotal() {
        var sum = 0;
        $(".total").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        document.getElementById('grandtotal').value = sum.toFixed(2);
        document.getElementById('grandtotalnon').value = sum;

        var jumlah1 = document.getElementById('jumlah1').value;
        var harga1 = document.getElementById('harga1').value;
        var total1 = parseInt(jumlah1) * parseInt(harga1);
        if (!isNaN(total1)) {
            document.getElementById('total1').value = total1;
        } else {
            document.getElementById('total1').value = 0;
        }

        var jumlah2 = document.getElementById('jumlah2').value;
        var harga2 = document.getElementById('harga2').value;
        var total2 = parseInt(jumlah2) * parseInt(harga2);
        if (!isNaN(total2)) {
            document.getElementById('total2').value = total2;
        } else {
            document.getElementById('total2').value = 0;
        }

        var jumlah3 = document.getElementById('jumlah3').value;
        var harga3 = document.getElementById('harga3').value;
        var total3 = parseInt(jumlah3) * parseInt(harga3);
        if (!isNaN(total3)) {
            document.getElementById('total3').value = total3;
        } else {
            document.getElementById('total3').value = 0;
        }

        var jumlah4 = document.getElementById('jumlah4').value;
        var harga4 = document.getElementById('harga4').value;
        var total4 = parseInt(jumlah4) * parseInt(harga4);
        if (!isNaN(total4)) {
            document.getElementById('total4').value = total4;
        } else {
            document.getElementById('total4').value = 0;
        }

        var jumlah5 = document.getElementById('jumlah5').value;
        var harga5 = document.getElementById('harga5').value;
        var total5 = parseInt(jumlah5) * parseInt(harga5);
        if (!isNaN(total5)) {
            document.getElementById('total5').value = total5;
        } else {
            document.getElementById('total5').value = 0;
        }

        var jumlah6 = document.getElementById('jumlah6').value;
        var harga6 = document.getElementById('harga6').value;
        var total6 = parseInt(jumlah6) * parseInt(harga6);
        if (!isNaN(total6)) {
            document.getElementById('total6').value = total6;
        } else {
            document.getElementById('total6').value = 0;
        }

        var jumlah7 = document.getElementById('jumlah7').value;
        var harga7 = document.getElementById('harga7').value;
        var total7 = parseInt(jumlah7) * parseInt(harga7);
        if (!isNaN(total7)) {
            document.getElementById('total7').value = total7;
        } else {
            document.getElementById('total7').value = 0;
        }

        var jumlah8 = document.getElementById('jumlah8').value;
        var harga8 = document.getElementById('harga8').value;
        var total8 = parseInt(jumlah8) * parseInt(harga8);
        if (!isNaN(total8)) {
            document.getElementById('total8').value = total8;
        } else {
            document.getElementById('total8').value = 0;
        }

        var jumlah9 = document.getElementById('jumlah9').value;
        var harga9 = document.getElementById('harga9').value;
        var total9 = parseInt(jumlah9) * parseInt(harga9);
        if (!isNaN(total9)) {
            document.getElementById('total9').value = total9;
        } else {
            document.getElementById('total9').value = 0;
        }
    }

    $('#tabelform').on('change', '.namabarang', function() {
        var $select = $(this);
        var namabarang = $select.val();
        var $row = $(this).closest('tr');
        $row.find('.harga')
            .val(
                $(this).find(':selected').data('price')
            );
    });

    $(function() {
        setInterval(kembalian, 100);
    });

    function kembalian() {
        var grandtotal = document.getElementById('grandtotal').value;
        var uangpembeli = document.getElementById('uangpembeli').value;
        var kembalian = parseInt(uangpembeli) - parseInt(grandtotal);
        if (!isNaN(kembalian)) {
            document.getElementById('kembalian').value = kembalian;
        } else {
            document.getElementById('kembalian').value = 0;
        }
    }
</script>