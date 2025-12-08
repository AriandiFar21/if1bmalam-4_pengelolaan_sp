<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    die("NIM tidak ditemukan!");
}

$id = $_GET['id'];

$sql = "DELETE FROM user WHERE id = '$id'";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>
        alert('User berhasil dihapus!');
        window.location='kelola_user.php';
    </script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
