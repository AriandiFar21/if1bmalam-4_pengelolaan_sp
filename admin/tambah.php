<?php
include 'koneksi.php';

$nim      = $_POST['nim'];
$nama     = $_POST['nama'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role     = $_POST['role'];

$input = mysqli_query($koneksi, "INSERT INTO user (nim, nama, password, role)
VALUES('$nim', '$nama', '$password', '$role')");

if($input){
    echo "<script>
        alert('User berhasil ditambahkan!');
        window.location='index.php';
    </script>";
}else{
    echo "<script>
        alert('Gagal menambah user!');
        window.location='index.php';
    </script>";
}
?>