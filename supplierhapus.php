<?php
// Tambahkan koneksi database
include 'koneksi.php';

// Pastikan parameter 'id' tersedia sebelum digunakan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Jalankan query DELETE
    $koneksi->query("DELETE FROM supplier WHERE idsupplier='$id'");

    echo "<script>alert('Data Berhasil Dihapus');</script>";
} else {
    echo "<script>alert('ID tidak ditemukan!');</script>";
}

// Redirect ke halaman daftar supplier
echo "<script>location='supplierdaftar.php';</script>";
?>

