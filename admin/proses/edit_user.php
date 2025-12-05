<?php
session_start();
include("../koneksi.php");

if (isset($_POST['update'])) {

    $id       = $_POST['id'];
    $nim      = $_POST['nim'];
    $nama     = $_POST['nama'];
    $password = $_POST['password'];
    $role     = $_POST['role'];
    $status   = $_POST['status'];

    $query = "UPDATE user SET 
                nim = '$nim',
                nama = '$nama',
                password = '$password',
                role = '$role',
                status = '$status'
              WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('User berhasil diperbarui!');
                window.location.href='../kelola_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui user: " . mysqli_error($koneksi) . "');
                window.location.href='../kelola_user.php';
              </script>";
    }

} else {
    echo "<script>
            alert('Akses tidak valid!');
            window.location.href='../kelola_user.php';
          </script>";
}
?>
