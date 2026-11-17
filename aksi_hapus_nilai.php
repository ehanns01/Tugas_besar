<?php
include 'koneksi.php';

// Ambil ID nilai dari parameter URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if (empty($id)) {
    echo "<script>alert('ID Nilai tidak valid!'); window.location='Daftar_nilai.php';</script>";
    exit;
}

// Ambil data mapel_id dan kelas terlebih dahulu sebelum dihapus (untuk keperluan redirect kembali)
$query_cek = "SELECT nilai_rapor.*, siswa.kelas, mapel.id AS mapel_id 
              FROM nilai_rapor 
              JOIN siswa ON nilai_rapor.siswa_id = siswa.id 
              JOIN mapel ON nilai_rapor.mapel_id = mapel.id 
              WHERE nilai_rapor.id = '$id'";
$result_cek = mysqli_query($koneksi, $query_cek);

if ($result_cek && mysqli_num_rows($result_cek) > 0) {
    $data = mysqli_fetch_assoc($result_cek);
    $mapel_id = $data['mapel_id'];
    $kelas = $data['kelas'];

    // Proses hapus data dari tabel nilai_rapor
    $query_hapus = "DELETE FROM nilai_rapor WHERE id = '$id'";
    $hasil_hapus = mysqli_query($koneksi, $query_hapus);

    if ($hasil_hapus) {
        echo "<script>alert('Nilai berhasil dihapus!'); window.location='Daftar_nilai.php?mapel_id=$mapel_id&kelas=$kelas';</script>";
    } else {
        echo "<script>alert('Gagal menghapus nilai: " . mysqli_error($koneksi) . "'); window.location='Daftar_nilai.php?mapel_id=$mapel_id&kelas=$kelas';</script>";
    }
} else {
    echo "<script>alert('Data nilai tidak ditemukan!'); window.location='Daftar_nilai.php';</script>";
}
?>