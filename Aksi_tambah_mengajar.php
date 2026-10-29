<?php
include 'koneksi.php';

// Memeriksa apakah request dikirimkan melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mapel_id = mysqli_real_escape_string($koneksi, $_POST['mapel_id']);
    $siswa_id = mysqli_real_escape_string($koneksi, $_POST['siswa_id']);

    // Query untuk memasukkan data ke tabel penghubung/mengajar
    $sql = "INSERT INTO mengajar (mapel_id, siswa_id) VALUES ('$mapel_id', '$siswa_id')";
    $query = mysqli_query($koneksi, $sql);

    // PERBAIKAN: Ubah $result menjadi $query sesuai dengan variabel di atas
    if ($query) {
        // Jika berhasil, arahkan kembali ke halaman daftar mapel
        echo "<script>alert('Data berhasil ditambahkan');window.location='daftar_mengajar.php';</script>";
  } else {
    // PERBAIKAN: Tambahkan .php pada daftar_mengajar.php
    echo "<script>alert('Gagal menambahkan data');window.location='daftar_mengajar.php';</script>";
  }
} else {
    // Jika diakses langsung tanpa form, kembalikan ke halaman mengajar
    header("Location: daftar_mengajar.php");
    exit();
}
?>