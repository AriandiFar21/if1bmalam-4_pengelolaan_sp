<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: ../index.php");
    exit();
}
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
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
                <a class="nav-link text-white fw-bold fs-6" href="index.php">Dashboard SP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold fs-6" href="history.php">History SP</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-white fw-bold fs-6" href="ganti_password.php">Ganti Password</a>
            </li>
        </ul>
        <ul class="mt-auto">
            <a href="../logout.php" type="button" class="btn btn-light fw-bold">LogOut</a>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="content-wrapper p-4">
                <div class="welcome-banner p-4 rounded-3 d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-0">Ganti Password</h2>
                        <h2 class="fw-bold fs-5">Amankan akun Anda dengan mengganti password secara berkala</h2>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="proses_ganti_password.php" method="POST">
                            <div class="mb-3">
                                <label for="password_lama" class="form-label fw-bold">Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" required placeholder="Masukkan password saat ini">
                            </div>
                            <div class="mb-3">
                                <label for="password_baru" class="form-label fw-bold">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required placeholder="Masukkan password baru">
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi_password" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required placeholder="Ulangi password baru">
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Simpan Password</button>
                            </div>
                        </form>
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