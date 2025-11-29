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
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History Surat Peringatan</title>
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
                <a class="nav-link active text-white fw-bold fs-6" href="history.php">History Surat Peringatan</a>
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
                        <h2 class="fw-bold fs-5">Pengelolaan Surat Peringatan</h2< /h2>
                    </div>
                    <div class="text-end">
                        <p class="mb-0">NIM: <?= $_SESSION['nim']; ?></p>
                        <p class="mb-0 small">Anda Login Sebagai Mahasiswa</p>
                    </div>
                </div>

                <h4 class="mt-5 mb-3 fw-bold">History Surat Peringatan Anda :</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Jenis SP</th>
                                <th>Tanggal Diterbitkan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class="text-center"><?= $row['jenis_sp']; ?></td>
                                        <td class="text-center"><?= date('d F Y', strtotime($row['tanggal_terbit'])); ?></td>
                                        <td class="text-center">
                                            <?php if ($row['status'] == 'Aktif') { ?>
                                                <span class="badge bg-danger">Aktif (Berlaku)</span>
                                            <?php } else { ?>
                                                <span class="badge bg-success">Selesai / Diarsipkan</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailSpModal"
                                                data-jenis="<?= $row['jenis_sp']; ?>"
                                                data-tanggal="<?= date('d F Y', strtotime($row['tanggal_terbit'])); ?>"
                                                data-pelanggaran="<?= $row['pelanggaran']; ?>"
                                                data-keterangan="<?= $row['keterangan']; ?>"
                                                data-status="<?= $row['status']; ?>">
                                                Lihat Keterangan
                                            </button>

                                            <a href="cetak_sp.php?id=<?= $row['id_sp']; ?>" target="_blank" class="btn btn-success btn-sm">
                                                Cetak SP
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } // Akhir loop
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">Anda belum memiliki riwayat surat peringatan.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailSpModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalJenisSp">Detail Surat Peringatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Pelanggaran:</label>
                        <p id="modalPelanggaran">-</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Tindak Lanjut / Keterangan:</label>
                        <p id="modalKeterangan">-</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <label class="fw-bold">Tanggal Diterbitkan:</label>
                            <p id="modalTanggal">-</p>
                        </div>
                        <div class="col-6">
                            <label class="fw-bold">Status:</label>
                            <p><span class="badge bg-warning" id="modalStatus">-</span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <script>
        // Ambil elemen modal
        const detailModal = document.getElementById('detailSpModal');
        detailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            // Ambil data dari atribut `data-*` di tombol
            const jenis = button.getAttribute('data-jenis');
            const tanggal = button.getAttribute('data-tanggal');
            const pelanggaran = button.getAttribute('data-pelanggaran');
            const keterangan = button.getAttribute('data-keterangan');
            const status = button.getAttribute('data-status');

            // Cari elemen di dalam modal berdasarkan ID-nya
            const modalTitle = detailModal.querySelector('.modal-title');
            const modalPelanggaran = detailModal.querySelector('#modalPelanggaran');
            const modalKeterangan = detailModal.querySelector('#modalKeterangan');
            const modalTanggal = detailModal.querySelector('#modalTanggal');
            const modalStatus = detailModal.querySelector('#modalStatus');

            // Masukkan data ke dalam elemen modal
            modalTitle.textContent = 'Detail ' + jenis;
            modalPelanggaran.textContent = pelanggaran;
            modalKeterangan.textContent = keterangan;
            modalTanggal.textContent = tanggal;
            modalStatus.textContent = status;
        });
    </script>
</body>

</html>