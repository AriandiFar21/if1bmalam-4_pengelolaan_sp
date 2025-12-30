<?php
include "../koneksi.php";

// Cegah akses tanpa POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: kelola_user.php");
  exit();
}

$nim      = $_POST['nim'];
$nama     = $_POST['nama'];
$password = $_POST['password'];
$role     = $_POST['role'];
$kelas     = $_POST['kelas'];

// Cek apakah user sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE nim='$nim'");
if (mysqli_num_rows($cek) > 0) {
  echo "<script>
            alert('User sudah ada!');
            window.location='kelola_user.php';
          </script>";
  exit();
}

// Insert data
$query = mysqli_query(
  $koneksi,
  "INSERT INTO user (nim, nama, password, role, kelas)
     VALUES('$nim', '$nama', '$password', '$role', '$kelas')"
);

// Jika berhasil
if ($query) {
  echo "<script>
            alert('User berhasil ditambahkan!');
            window.location='kelola_user.php';
          </script>";
} else {
  echo "<script>
            alert('Gagal menambahkan user!');
            window.location='kelola_user.php';
          </script>";
}
