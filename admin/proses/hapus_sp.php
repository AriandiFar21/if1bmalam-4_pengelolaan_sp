<?php
include("../../koneksi.php");

$id = $_GET['id'];
$sql = "DELETE FROM sp WHERE id_sp = '$id'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Data SP berhasil dihapus'); window.location.href = '../kelola_sp.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); window.location.href = '../kelola_sp.php';</script>";
}
