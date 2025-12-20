<?php
session_start();
include("../koneksi.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : "";

// --- PAGINATION ---
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$sqlCount = "SELECT COUNT(*) AS total FROM user 
             WHERE nim LIKE '%$search%' 
             OR nama LIKE '%$search%' 
             OR role LIKE '%$search%'";
$execCount = mysqli_query($koneksi, $sqlCount);
$total_data = mysqli_fetch_assoc($execCount)['total'];
$total_page = ceil($total_data / $limit);

// Query utama
$sql = "SELECT * FROM user 
        WHERE nim LIKE '%$search%' 
        OR nama LIKE '%$search%' 
        OR role LIKE '%$search%' 
        ORDER BY id DESC 
        LIMIT $start, $limit";

$result = mysqli_query($koneksi, $sql);
$no = $start + 1;

if (!$result) {
  die("Query Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola User</title>
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
        <a class="nav-link text-white fw-bold fs-6" href="kelola_sp.php">Kelola Surat Peringatan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-white fw-bold fs-6" href="kelola_user.php">Kelola User</a>
      </li>
    </ul>
    <ul class="mt-auto">
      <button type="button" class="btn btn-light fw-bold" data-bs-toggle="modal" data-bs-target="#modalLogout">
        LogOut
      </button>
    </ul>


  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="content-wrapper p-4">
        <div class="welcome-banner p-4 rounded-3 d-flex justify-content-between align-items-center">
          <div>
            <h2 class="fw-bold mb-0">Kelola User</h2>
            <h2 class="fw-bold fs-5"> Kelola user dengan mudah dan cepat </h2>
          </div>
          <div class="text-end">
            <p class="mb-0">Halo, <?= $_SESSION['nim']; ?></p>
            <p class="mb-0 small">Anda Login Sebagai Admin</p>
          </div>
        </div>

        <div class="mt-3">
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            Tambah User +
          </button>
        </div>

        <div class="table-responsive">
          <form method="GET" class="mt-3 d-flex" style="max-width: 300px;">
            <input type="text" name="search" class="form-control" placeholder="Cari user..." value="<?= $search ?>">
            <button class="btn btn-dark ms-2">Cari</button>
          </form>

          <table class="mt-4 table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>NIM / ID Staff</th>
                <th>Nama Lengkap</th>
                <th>Password</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['password']; ?></td>
                    <td>
                      <?php ?>
                      <?php if ($row['role'] == 'staff_akademik') { ?>
                        <span class="badge bg-primary">Staff Akademik</span>
                      <?php } elseif ($row['role'] == 'mahasiswa') { ?>
                        <span class="badge bg-success">Mahasiswa</span>
                      <?php  } elseif ($row['role'] == 'dosen') { ?>
                        <span class="badge bg-info">Dosen</span>
                      <?php
                      } ?>
                    </td>
                    <td class="d-flex gap-2 justify-content-center">
                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>">Edit</button>
                      <a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?');">Hapus</a>
                    </td>
                  </tr>

                  <div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                          <h5 class="modal-title">Edit User</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="proses/edit_user.php" method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">

                            <label class="mt-2">NIM / ID Staff</label>
                            <input type="text" name="nim" class="form-control" value="<?= $row['nim']; ?>" required>

                            <label class="mt-2">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>

                            <label class="mt-2">Password</label>
                            <input type="text" name="password" class="form-control" value="<?= $row['password']; ?>" required>

                            <label class="mt-2">Role</label>
                            <select name="role" class="form-select">
                              <option value="staff_akademik" <?= ($row['role'] == 'staff_akademik') ? 'selected' : '' ?>>staff akademik</option>
                              <option value="mahasiswa" <?= ($row['role'] == 'mahasiswa') ? 'selected' : '' ?>>mahasiswa</option>
                            </select>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php }
              } else { ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada user ditemukan.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <nav>
            <ul class="pagination justify-content-center">
              <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= $search ?>">Prev</a>
              </li>
              <li class="page-item <?= ($page >= $total_page) ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Tambah User Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="tambah_user.php" method="POST">
          <div class="modal-body">
            <label class="mt-2">NIM / ID Staff</label>
            <input type="text" name="nim" class="form-control" required>

            <label class="mt-2">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>

            <label class="mt-2">Password</label>
            <input type="text" name="password" class="form-control" required>

            <label class="mt-2">Role</label>
            <select name="role" class="form-select">
              <option value="mahasiswa">Mahasiswa</option>
              <option value="staff_akademik">Staff Akademik</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah User</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLogoutLabel">Konfirmasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="../auth/logout.php" class="btn btn-danger">Ya, Logout</a>
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