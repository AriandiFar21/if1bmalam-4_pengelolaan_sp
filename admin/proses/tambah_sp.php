<?php
session_start();
include("../../koneksi.php");

if (!isset($_SESSION['nim'])) {
    echo "<script>alert('Sesi habis, silakan login kembali.'); window.location.href = '../../index.php';</script>";
    exit();
}

$nim                = mysqli_real_escape_string($koneksi, $_POST["nim"]);
$nama_mahasiswa     = mysqli_real_escape_string($koneksi, $_POST["nama_mahasiswa"]);
$jenis_sp           = mysqli_real_escape_string($koneksi, $_POST["jenis_sp"]);
$pelanggaran        = mysqli_real_escape_string($koneksi, $_POST["pelanggaran"]);
$keterangan         = mysqli_real_escape_string($koneksi, $_POST["keterangan"]);
$pemberi_sp_nama    = mysqli_real_escape_string($koneksi, $_POST["pemberi_sp_nama"]);
$pemberi_sp_jabatan = mysqli_real_escape_string($koneksi, $_POST["pemberi_sp_jabatan"]);

// Data Otomatis
$tanggal_terbit     = date('Y-m-d');
$status             = 'Aktif';
$pemberi_sp_nim     = $_SESSION["nim"]; 

if (empty($nim)) {
    echo "<script>alert('Mohon pilih mahasiswa dari daftar yang muncul saat mengetik!'); window.location.href = '../kelola_sp.php';</script>";
    exit();
}

$sql = "INSERT INTO sp (
            nim_mahasiswa, nama_mahasiswa, jenis_sp, pelanggaran, 
            keterangan, tanggal_terbit, status, 
            pemberi_sp_nama, pemberi_sp_nim, pemberi_sp_jabatan
        ) VALUES (
            '$nim', '$nama_mahasiswa', '$jenis_sp', '$pelanggaran',
            '$keterangan', '$tanggal_terbit', '$status',
            '$pemberi_sp_nama', '$pemberi_sp_nim', '$pemberi_sp_jabatan'
        )";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Berhasil Menambah Data SP'); window.location.href = '../kelola_sp.php';</script>";
} else {
    echo "<script>alert('Gagal Menambah Data: " . mysqli_error($koneksi) . "'); window.location.href = '../kelola_sp.php';</script>";
}
?>