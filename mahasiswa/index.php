<?php
// Mulai sesi untuk mendapatkan data login
session_start();
include("../koneksi.php");

// Keamanan dasar: Pastikan yang akses adalah mahasiswa yang sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    // Jika tidak, tendang kembali ke halaman login
    header("Location: ../index.php");
    exit();
}

// Ambil NIM mahasiswa dari sesi login
$nim_mahasiswa = $_SESSION['nim'];

$sql = "SELECT * FROM sp WHERE nim_mahasiswa = '$nim_mahasiswa' ORDER BY tanggal_terbit DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <i id="hamburger" class="bi bi-list fs-4 text-black"></i>

    <div id="sidebar" class="sidebar d-flex flex-column">
        <div class="row">
            <div class="col-3 mt-2">
                <img src="../FOTO/logo.png" class="ms-4 mt-2" width="80px" alt="" />
            </div>
            <div class="col-9 d-flex flex-column mt-3">
                <span class="text-decoration-none ms-5 fw-bold fs-6"> Website </span>
                <span class="text-decoration-none ms-5 fw-bold fs-6"> Pengelolaan </span>
                <span class="text-decoration-none ms-5 fw-bold fs-6"> SP </span>
            </div>
        </div>
        <hr style="color: white" />
        <ul class="d-flex nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white fw-bold fs-6" href="index.php">Dashboard SP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  text-white fw-bold fs-6" href="history.php">History Surat Peringatan</a>
            </li>
        </ul>
        <ul class="mt-auto">
            <a href="../auth/logout.php" type="button" class="btn btn-light fw-bold">LogOut</a>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="content-wrapper p-4">
                <div class="welcome-banner p-4 rounded-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-0">Selamat Datang di Portal SP</h2>
                        <h2 class="fw-bold fs-5">Pengelolaan Surat Peringatan</h2>
                    </div>
                    <div class="text-end">
                        <p class="mb-0">NIM: <?= $_SESSION['nim']; ?></p>
                        <p class="mb-0 small">Anda Login Sebagai Mahasiswa</p>
                    </div>
                </div>

                <h4 class="mt-5 mb-3 fw-bold">Daftar Surat Peringatan yang Diterbitkan untuk Anda</h4>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div style="background-color: #010825;" class="info-card card text-white p-4 rounded-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0"><?= $row['jenis_sp']; ?></h3>
                                <span> <?php if ($row['status'] == 'Aktif') { ?>
                                        <span class="badge bg-danger">Aktif (Berlaku)</span>
                                    <?php } else { ?>
                                        <span class="badge bg-success">Selesai / Diarsipkan</span>
                                    <?php } ?></span>

                            </div>

                            <p class="text-white fw-bold mb-1 text-white">Pelanggaran:</p>
                            <p><?= $row['pelanggaran']; ?></p>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="text-white fw-bold mb-1">Tanggal Diterbitkan:</p>
                                    <h5><?= date('d F Y', strtotime($row['tanggal_terbit'])); ?></h5>
                                </div>
                            </div>

                            <p class="text-white fw-bold mt-3 mb-1">Tindak Lanjut/Keterangan:</p>
                            <p class="mb-0"><?= $row['keterangan']; ?></p>
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-info mt-3">
                        Anda belum memiliki riwayat surat peringatan.
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebar");

        hamburger.addEventListener("click", () => {
            sidebar.classList.toggle("show");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>