<?php
session_start();
include("../koneksi.php");

$sql = "SELECT * FROM sp";
$conditions = [];

if (isset($_GET['search']) && $_GET['search'] != '') {
  $search = $_GET['search'];
  $conditions[] = "(nama_mahasiswa LIKE '%$search%' OR nim_mahasiswa LIKE '%$search%')";
}

if (isset($_GET['jenis_sp']) && $_GET['jenis_sp'] != '') {
  $jenis_sp = $_GET['jenis_sp'];
  $conditions[] = "jenis_sp = '$jenis_sp'";
}

if (count($conditions) > 0) {
  $sql = $sql . " WHERE " . implode(' AND ', $conditions);
}

$sql .= " ORDER BY tanggal_terbit DESC"; // Urutkan dari yang terbaru
$result = mysqli_query($koneksi, $sql);
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Page</title>
  <link rel="stylesheet" href="css/kelola_sp.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <a class="nav-link text-white fw-bold fs-6" href="index.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-white fw-bold fs-6" href="kelola_sp.php">Kelola Surat Peringatan</a>
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
            <h2 class="fw-bold mb-0">Daftar Surat Peringatan</h2>
            <h2 class="fw-bold fs-5"> Kelola data SP dengan mudah dan cepat </h2>
          </div>
          <div class="text-end">
            <p class="mb-0">Halo, <?php echo $_SESSION['nim']; ?></p>
            <p class="mb-0 small">Anda Login Sebagai Admin</p>
          </div>
        </div>

        <form action="kelola_sp.php" method="GET" class="row mt-3 g-2">
          <div class="col-12 col-md-4">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari nama atau nim..." value="<?= $_GET['search'] ?? '' ?>" />
          </div>
          <div class="col-6 col-md-3">
            <select name="jenis_sp" class="form-select h-100">
              <option value="">Jenis SP</option>
              <option value="SP1" <?= ($_GET['jenis_sp'] ?? '') == 'SP1' ? 'selected' : '' ?>>SP1</option>
              <option value="SP2" <?= ($_GET['jenis_sp'] ?? '') == 'SP2' ? 'selected' : '' ?>>SP2</option>
              <option value="SP3" <?= ($_GET['jenis_sp'] ?? '') == 'SP3' ? 'selected' : '' ?>>SP3</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
          </div>
          <div class="col-12 col-md-2">
            <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#modalTambah">
              Tambah SP +
            </button>
          </div>
        </form>

        <div class="table-responsive mt-3">
          <table class="table align-middle">
            <thead>
              <tr class="table-secondary">
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Jenis (SP)</th>
                <th>Tanggal Terbit</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $row['nama_mahasiswa']; ?></td>
                  <td><?= $row['nim_mahasiswa']; ?></td>
                  <td><?= $row['jenis_sp']; ?></td>
                  <td><?= $row['tanggal_terbit']; ?></td>
                  <td>
                    <?php if ($row['status'] == 'Aktif'): ?>
                      <span class="badge bg-danger">Aktif</span>
                    <?php else: ?>
                      <span class="badge bg-success">Diarsipkan</span>
                    <?php endif; ?>
                  </td>
                  <td class="d-flex gap-2">
                    <button type="button" class="fw-bold text-decoration-none text-primary" style="border:none; background:none;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_sp']; ?>">
                      Edit
                    </button>
                    <a class="fw-bold text-decoration-none text-danger" href="proses/hapus_sp.php?id=<?= $row['id_sp']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    <a class="fw-bold text-decoration-none text-warning"
                      href="proses/arsip_sp.php?id=<?= $row['id_sp']; ?>"
                      onclick="return confirm('Yakin ingin mengarsipkan (menyelesaikan) kasus ini?');">
                      Arsip
                    </a>
                  </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_sp']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-dark text-white">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data SP</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="proses/edit_sp_proses.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" name="id_sp" value="<?= $row['id_sp']; ?>">

                          <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa (Read-Only)</label>
                            <input type="text" class="form-control bg-light" value="<?= $row['nama_mahasiswa']; ?>" readonly>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Jenis SP</label>
                            <select name="jenis_sp" class="form-select" required>
                              <option value="SP1" <?= ($row['jenis_sp'] == 'SP1') ? 'selected' : '' ?>>SP1</option>
                              <option value="SP2" <?= ($row['jenis_sp'] == 'SP2') ? 'selected' : '' ?>>SP2</option>
                              <option value="SP3" <?= ($row['jenis_sp'] == 'SP3') ? 'selected' : '' ?>>SP3</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Pelanggaran</label>
                            <textarea name="pelanggaran" class="form-control" rows="3" required><?= $row['pelanggaran']; ?></textarea>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2"><?= $row['keterangan']; ?></textarea>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                              <option value="Aktif" <?= ($row['status'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                              <option value="Selesai" <?= ($row['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php
              }
              if (mysqli_num_rows($result) == 0) {
              ?>
                <tr>
                  <td colspan="9" class="text-center">Tidak ada data Surat Peringatan ditemukan.</td>
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

  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Surat Peringatan</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="proses/tambah_sp.php" method="POST">
          <div class="modal-body">
            <h6 class="fw-bold">Data Mahasiswa</h6>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Cari NIM Mahasiswa</label>
                <input class="form-control" list="nim-options" id="nim_search" placeholder="Ketik NIM/Nama..." required>
                <datalist id="nim-options">
                  <?php
                  // Query ulang untuk list mahasiswa di modal tambah
                  $query_mhs = "SELECT nim, nama FROM user WHERE role = 'mahasiswa' ORDER BY nim ASC";
                  $result_mhs = mysqli_query($koneksi, $query_mhs);
                  while ($mhs = mysqli_fetch_assoc($result_mhs)) {
                    echo "<option value='{$mhs['nim']} - {$mhs['nama']}' data-nim='{$mhs['nim']}' data-nama='{$mhs['nama']}'></option>";
                  }
                  ?>
                </datalist>
                <input type="hidden" name="nim" id="nim_hidden">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" readonly required>
              </div>
            </div>

            <h6 class="fw-bold mt-3">Detail SP</h6>
            <div class="mb-3">
              <label class="form-label">Jenis SP</label>
              <select name="jenis_sp" class="form-select" required>
                <option value="SP1">SP1</option>
                <option value="SP2">SP2</option>
                <option value="SP3">SP3</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Pelanggaran</label>
              <textarea name="pelanggaran" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="2"></textarea>
            </div>

            <h6 class="fw-bold mt-3">Pemberi SP</h6>
            <div class="mb-3">
              <label class="form-label">Nama Pemberi SP</label>
              <input type="text" name="pemberi_sp_nama" class="form-control" placeholder="Contoh: Fariel Ariandi" required>
              <label class="form-label">Jabatan</label>
              <input type="text" name="pemberi_sp_jabatan" class="form-control" placeholder="Contoh: Kepala Akademik" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const hamburger = document.getElementById("hamburger");
    const sidebar = document.getElementById("sidebar");
    hamburger.addEventListener("click", () => {
      sidebar.classList.toggle("show");
    });

    // Script untuk pencarian NIM di Modal Tambah
    const searchInput = document.getElementById('nim_search');
    const nimHiddenInput = document.getElementById('nim_hidden');
    const namaMahasiswaInput = document.getElementById('nama_mahasiswa');
    const datalist = document.getElementById('nim-options');

    searchInput.addEventListener('input', function() {
      const selectedValue = this.value;
      let found = false;
      for (const option of datalist.options) {
        if (option.value === selectedValue) {
          nimHiddenInput.value = option.getAttribute('data-nim');
          namaMahasiswaInput.value = option.getAttribute('data-nama');
          found = true;
          break;
        }
      }
      if (!found) {
        nimHiddenInput.value = '';
        namaMahasiswaInput.value = '';
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>