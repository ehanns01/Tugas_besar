<?php
include 'koneksi.php';

// Memeriksa apakah parameter 'id' ada dan tidak kosong pada URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Amankan parameter ID dari potensi SQL Injection
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query SQL untuk menghapus baris data berdasarkan ID
    $sql   = "DELETE FROM mengajar WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        // Jika berhasil dihapus, tampilkan notifikasi dan alihkan kembali ke daftar mengajar
        echo "<script>alert('Data berhasil dihapus!');window.location='daftar_mengajar.php';</script>";
    } else {
        // Jika gagal menghapus data
        echo "<script>alert('Gagal menghapus data!');window.location='daftar_mengajar.php';</script>";
    }
} else {
    // Jika halaman diakses langsung tanpa parameter ID
    header("Location: daftar_mengajar.php");
    exit();
}
?>