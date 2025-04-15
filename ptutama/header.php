<?php
include 'koneksi.php';
function tanggal($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function rupiah($angka)
{
  $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasilrupiah;
}
function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>PT Utama</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


</head>

<body class="content" style="max-width: 100%; width: 100vw; margin: 0; padding: 0;">
<header class="navbar">
    <div>PT Utama</div>
    <div class="menu">
        <a href="beranda.php">Home</a>
        <a href="gudangdaftar.php">Data Gudang</a>
        <a href="supplierdaftar.php">Data Supplier</a>
        <a href="penggunadaftar.php">Customer</a>
        <a href="produkdaftar.php">Barang</a>
        <a href="penjualandaftar.php">Penjualan</a>
        <a href="pembeliandaftar.php">Pembelian</a>
        <?php if (isset($_SESSION["admin"])) { ?>
            <a href="logout.php">Logout</a>
        <?php } ?>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fa fa-bars"></i>
    </div>
</header>

<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

<div class="sidebar" id="sidebar">
    <a href="beranda.php">Home</a>
    <a href="gudangdaftar.php">Data Gudang</a>
    <a href="supplierdaftar.php">Data Supplier</a>
    <a href="penggunadaftar.php">Customer</a>
    <a href="produkdaftar.php">Barang</a>
    <a href="penjualandaftar.php">Penjualan</a>
    <a href="pembeliandaftar.php">Pembelian</a>
    <?php if (isset($_SESSION["admin"])) { ?>
        <a href="logout.php">Logout</a>
    <?php } ?>
</div>