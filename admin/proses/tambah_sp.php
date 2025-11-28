<?php
session_start();
include("../../koneksi.php");

// Data Mahasiswa & SP dari Form
$nim = $_POST["nim"];
$nama_mahasiswa = $_POST["nama_mahasiswa"];
$jenis_sp = $_POST["jenis_sp"];
$pelanggaran = $_POST["pelanggaran"];
$keterangan = $_POST["keterangan"];
$tanggal_terbit = date('Y-m-d');
$status = 'Aktif';
$pemberi_sp_nama = $_POST["pemberi_sp_nama"];

// Data Pemberi SP (Staff yang sedang login)
$pemberi_sp_nim = $_SESSION["nim"];
$pemberi_sp_jabatan = $_POST["pemberi_sp_jabatan"];

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
    // Arahkan ke kelola_sp.php jika berhasil
    echo "<script>alert('Berhasil Menambah Data SP'); window.location.href = '../kelola_sp.php';</script>";
} else {
    // Arahkan kembali ke tambah_sp.php jika gagal
    echo "<script>alert('Gagal Menambah Data'); window.location.href = '../tambah_sp.php';</script>";
}
