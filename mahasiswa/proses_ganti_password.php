<?php
session_start();
include("../koneksi.php");

if (!isset($_SESSION['nim'])) {
    die("Akses ditolak.");
}

$nim = $_SESSION['nim'];
$pass_lama = $_POST['password_lama'];
$pass_baru = $_POST['password_baru'];
$konfirmasi = $_POST['konfirmasi_password'];

if ($pass_baru !== $konfirmasi) {
    echo "<script>alert('Password baru dan konfirmasi tidak cocok!'); window.location='ganti_password.php';</script>";
    exit();
}

$query = mysqli_query($koneksi, "SELECT password FROM user WHERE nim = '$nim'");
$data = mysqli_fetch_assoc($query);
$password_db = $data['password'];


if ($pass_lama === $password_db) {

    $update = mysqli_query($koneksi, "UPDATE user SET password = '$pass_baru' WHERE nim = '$nim'");

    if ($update) {
        echo "<script>alert('Password berhasil diubah! Silakan login ulang.'); window.location='../auth/logout.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah password. Silakan coba lagi.'); window.location='ganti_password.php';</script>";
    }
} else {
    echo "<script>alert('Password lama salah!'); window.location='ganti_password.php';</script>";
}
