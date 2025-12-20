<?php
session_start();
include("../koneksi.php");

// 1. Cek Login & Role Dosen
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../index.php");
    exit();
}

$nip_dosen = $_SESSION['nim'];
$nama_dosen = $_SESSION['nama'];
$kelas_wali = $_SESSION['kelas'];

// Query data SP mahasiswa di kelas wali
$sql = "SELECT sp.*, user.nama, user.kelas 
        FROM sp 
        JOIN user ON sp.nim_mahasiswa = user.nim 
        WHERE user.kelas = '$kelas_wali' 
        ORDER BY sp.tanggal_terbit DESC";

$result = mysqli_query($koneksi, $sql);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Dosen Wali</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css">

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
                <a class="nav-link active text-white fw-bold fs-6" href="kelola_sp.php">Monitoring SP</a>
            </li>
        </ul>
        <ul class="mt-auto">
            <a href="../auth/logout.php" type="button" class="btn btn-light fw-bold">LogOut</a>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="content-wrapper p-4">

                <div class="welcome-banner p-4 rounded-3 d-flex justify-content-between align-items-center shadow">
                    <div>
                        <h2 class="fw-bold mb-0">Dashboard Dosen Wali</h2>
                        <h2 class="fw-bold fs-5 mt-1"> Monitoring Mahasiswa Kelas <?= $kelas_wali; ?> </h2>
                    </div>
                    <div class="text-end d-none d-sm-block">
                        <p class="mb-0 fs-5">Halo, <?= $nama_dosen; ?></p>
                        <p class="mb-0 small bg-warning text-dark px-2 rounded d-inline-block fw-bold mt-1">Dosen Wali</p>
                    </div>
                </div>

                <div class="table-responsive mt-4 bg-white p-3 rounded shadow-sm">
                    <h5 class="mb-3 fw-bold"><i class="bi bi-table me-2"></i>Daftar Mahasiswa Terkena SP</h5>

                    <table class="table align-middle table-hover">
                        <thead>
                            <tr class="table-secondary">
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Jenis SP</th>
                                <th>Pelanggaran</th>
                                <th>Tanggal Terbit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_mahasiswa']; ?></td>
                                        <td><span class="fw-bold"><?= $row['nim_mahasiswa']; ?></span></td>
                                        <td>
                                            <?php
                                            $badgeClass = 'bg-secondary';
                                            if ($row['jenis_sp'] == 'SP1') $badgeClass = 'bg-warning text-dark';
                                            if ($row['jenis_sp'] == 'SP2') $badgeClass = 'bg-warning text-dark'; // Atau warna orange jika ada class custom
                                            if ($row['jenis_sp'] == 'SP3') $badgeClass = 'bg-danger';
                                            ?>
                                            <span class="badge rounded-pill <?= $badgeClass; ?>">
                                                <?= $row['jenis_sp']; ?>
                                            </span>
                                        </td>
                                        <td><?= $row['pelanggaran']; ?></td>
                                        <td><?= date('d M Y', strtotime($row['tanggal_terbit'])); ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Aktif'): ?>
                                                <span class="badge bg-danger">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-emoji-smile fs-1 text-success"></i>
                                        <h5 class="mt-3 text-muted">Aman! Tidak ada data SP di kelas ini.</h5>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>