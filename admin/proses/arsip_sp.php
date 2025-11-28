<?php
include("../../koneksi.php");

// Ambil ID dari URL
$id = $_GET['id'];

// Ubah status menjadi 'Diarsipkan' (atau 'Selesai')
$sql = "UPDATE sp SET status = 'Diarsipkan' WHERE id_sp = '$id'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Data SP berhasil diarsipkan'); window.location.href = '../kelola_sp.php';</script>";
} else {
    echo "<script>alert('Gagal mengarsipkan data'); window.location.href = '../kelola_sp.php';</script>";
}
