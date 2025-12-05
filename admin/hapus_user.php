<?php
include '../koneksi.php';

if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan!");
}

$nim = $_GET['nim'];

$sql = "DELETE FROM user WHERE nim = '$nim'";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>
        alert('User berhasil dihapus!');
        window.location='user.php';
    </script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
