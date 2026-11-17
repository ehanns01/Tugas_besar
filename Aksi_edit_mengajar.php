<?php
include 'koneksi.php';

// Memeriksa apakah request dikirimkan melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id       = mysqli_real_escape_string($koneksi, $_POST['id']);
    $mapel_id = mysqli_real_escape_string($koneksi, $_POST['mapel_id']);
    $siswa_id = mysqli_real_escape_string($koneksi, $_POST['siswa_id']);

    // Query untuk memperbarui data pada tabel mengajar
    $sql   = "UPDATE mengajar SET mapel_id = '$mapel_id', siswa_id = '$siswa_id' WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        // Jika berhasil, arahkan kembali ke halaman daftar mengajar
        echo "<script>alert('Data berhasil diperbarui');window.location='daftar_mengajar.php';</script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Gagal memperbarui data');window.location='daftar_mengajar.php';</script>";
    }
} else {
    // Jika diakses langsung tanpa form POST
    header("Location: daftar_mengajar.php");
    exit();
}
?>