<?php
include("../../koneksi.php");

$id_sp = $_POST["id_sp"];
$jenis_sp = $_POST["jenis_sp"];
$pelanggaran = $_POST["pelanggaran"];
$keterangan = $_POST["keterangan"];
$status = $_POST["status"];

$sql = "UPDATE sp SET 
            jenis_sp = '$jenis_sp',
            pelanggaran = '$pelanggaran',
            keterangan = '$keterangan',
            status = '$status'
        WHERE id_sp = '$id_sp'";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Data SP berhasil diupdate'); window.location.href = '../kelola_sp.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate data'); window.location.href = '../edit_sp.php?id=$id_sp';</script>";
}
