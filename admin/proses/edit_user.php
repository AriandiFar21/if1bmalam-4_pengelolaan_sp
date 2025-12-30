<?php
session_start();
include("../../koneksi.php");

if (isset($_POST['update'])) {
  $id       = $_POST['id'];
  $nim      = $_POST['nim'];
  $nama     = $_POST['nama'];
  $password = $_POST['password'];
  $role     = $_POST['role'];

  // Ambil data kelas, jika kosong (misal staff) set jadi string kosong/null
  $kelas    = isset($_POST['kelas']) ? $_POST['kelas'] : '';

  $query = "UPDATE user SET 
              nim = '$nim',
              nama = '$nama',
              password = '$password',
              role = '$role',
              kelas = '$kelas'
              WHERE id = '$id'";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<script>
                alert('User berhasil diperbarui!');
                window.location.href='../kelola_user.php';
              </script>";
  } else {
    // Tampilkan error sql jika gagal (untuk debugging)
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
