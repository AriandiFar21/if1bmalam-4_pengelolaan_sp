proses/edit_user.php

<?php
session_start();
include("../../koneksi.php");

if (isset($_POST['update'])) {
  $id       = $_POST['id'];
  $nim      = $_POST['nim'];
  $nama     = $_POST['nama'];
  $password = $_POST['password'];
  $role     = $_POST['role'];

  // Koma sebelum WHERE dihapus agar tidak error
  $query = "UPDATE user SET 
            nim = '$nim',
            nama = '$nama',
            password = '$password',
            role = '$role'
            WHERE id = '$id'";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>
            alert('User berhasil diperbarui!');
            window.location.href='../kelola_user.php';
          </script>";
  } else {
    echo "<script>
            alert('Gagal memperbarui user');
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