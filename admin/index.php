<?php
session_start();
// Cek login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'staff_akademik') {
    header("Location: ../index.php");
    exit();
}

include("../koneksi.php");

// --- LOGIKA MENGHITUNG DATA (DASHBOARD) ---

// 1. Hitung Jumlah Mahasiswa
$query_mhs = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM user WHERE role = 'mahasiswa'");
$data_mhs = mysqli_fetch_assoc($query_mhs);
$jml_mhs = $data_mhs['total'];

// 2. Hitung Jumlah Staff (User Admin)
$query_staff = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM user WHERE role = 'staff_akademik'");
$data_staff = mysqli_fetch_assoc($query_staff);
$jml_staff = $data_staff['total'];

// 3. Hitung Total SP
$query_sp = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sp");
$data_sp = mysqli_fetch_assoc($query_sp);
$jml_sp = $data_sp['total'];

// 4. Hitung SP yang Masih Aktif (Bonus Info)
$query_sp_aktif = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sp WHERE status = 'Aktif'");
$data_sp_aktif = mysqli_fetch_assoc($query_sp_aktif);
$jml_sp_aktif = $data_sp_aktif['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/kelola_sp.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .info-card {
            transition: transform 0.3s;
            border: none;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }
    </style>
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
                <a class="nav-link active text-white fw-bold fs-6" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold fs-6" href="kelola_sp.php">Kelola Surat Peringatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold fs-6" href="kelola_user.php">Kelola User</a>
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
                        <h2 class="fw-bold mb-0">Selamat Datang</h2>
                        <h2 class="fw-bold fs-5">Website Pengelolaan Surat Peringatan</h2>
                    </div>
                    <div class="text-end">
                        <p class="mb-0">Halo, <?php echo $_SESSION['nim'] ?? 'Admin'; ?></p>
                        <p class="mb-0 small">Anda Login Sebagai Admin</p>
                    </div>
                </div>

                <h4 class="mt-5 mb-3 fw-bold">Informasi Singkat</h4>

                <div class="row mt-2 g-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card text-white bg-primary h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-people-fill fs-1 mb-2"></i>
                                <h5 class="card-title">Jumlah Mahasiswa</h5>
                                <h2 class="fw-bold display-6"><?php echo $jml_mhs; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card text-white bg-success h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-person-badge-fill fs-1 mb-2"></i>
                                <h5 class="card-title">Jumlah Staff</h5>
                                <h2 class="fw-bold display-6"><?php echo $jml_staff; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card text-white bg-danger h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-envelope-paper-fill fs-1 mb-2"></i>
                                <h5 class="card-title">Total SP Terbit</h5>
                                <h2 class="fw-bold display-6"><?php echo $jml_sp; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card text-dark bg-warning h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-exclamation-triangle-fill fs-1 mb-2"></i>
                                <h5 class="card-title">SP Masih Aktif</h5>
                                <h2 class="fw-bold display-6"><?php echo $jml_sp_aktif; ?></h2>
                            </div>
                        </div>
                    </div>

                </div>
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