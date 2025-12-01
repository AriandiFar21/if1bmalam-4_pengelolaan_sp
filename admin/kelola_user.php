<?php
session_start();
include("../koneksi.php");

// --- SEARCH ---
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : "";

// --- PAGINATION ---
$limit = 15; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data (untuk pagination)
$sqlCount = "SELECT COUNT(*) AS total FROM user 
             WHERE nim LIKE '%$search%' 
             OR nama LIKE '%$search%' 
             OR role LIKE '%$search%'";
$execCount = mysqli_query($koneksi, $sqlCount);
$total_data = mysqli_fetch_assoc($execCount)['total'];

$total_page = ceil($total_data / $limit);

// Query utama untuk mengambil data user
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

  <!-- SIDEBAR -->
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
      <a href="../logout.php" type="button" class="btn btn-light fw-bold">LogOut</a>
    </ul>
  </div>

  <!-- CONTENT -->
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

        <!-- BUTTON TAMBAH USER -->
        <div class="mt-3">
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            Tambah User +
          </button>
        </div>

        <!-- TABLE USER -->
        <div class="table-responsive mt-3">
            <!-- SEARCH -->
<form method="GET" class="mt-3 d-flex" style="max-width: 300px;">
  <input type="text" name="search" class="form-control" placeholder="Cari user..." value="<?= $search ?>">
  <button class="btn btn-dark ms-2">Cari</button>
</form>

          <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>NIM / ID Staff</th>
                <th>Nama Lengkap</th>
                <th>Password</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['password']; ?></td>
                    <td><?= $row['role']; ?></td>
                    <td>
                      <?php if ($row['status'] == 'Aktif') { ?>
                        <span class="badge bg-success">Aktif</span>
                      <?php } else { ?>
                        <span class="badge bg-secondary">Tidak Aktif</span>
                      <?php } ?>
                    </td>
                    <td class="d-flex gap-2 justify-content-center">
                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>">Edit</button>
                      <a href="proses/hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin ingin menghapus user ini?');">Hapus</a>
                    </td>
                  </tr>

                  <!-- MODAL EDIT USER -->
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
                              <option value="admin" <?= ($row['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                              <option value="mahasiswa" <?= ($row['role'] == 'mahasiswa') ? 'selected' : '' ?>>Mahasiswa</option>
                              <option value="staff" <?= ($row['role'] == 'staff') ? 'selected' : '' ?>>Staff</option>
                            </select>

                            <label class="mt-2">Status</label>
                            <select name="status" class="form-select">
                              <option value="Aktif" <?= ($row['status'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                              <option value="Tidak Aktif" <?= ($row['status'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>

                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

              <?php }
              } else { ?>
                <tr>
                  <td colspan="7" class="text-center">Tidak ada user ditemukan.</td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
          <!-- PAGINATION -->
<nav>
  <ul class="pagination justify-content-center">

    <!-- PREV -->
    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
      <a class="page-link"
        href="?page=<?= $page - 1 ?>&search=<?= $search ?>">Prev</a>
    </li>

    <!-- NEXT -->
    <li class="page-item <?= ($page >= $total_page) ? 'disabled' : '' ?>">
      <a class="page-link"
        href="?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
    </li>

  </ul>
</nav>

        </div>
      </div>
    </div>
  </div>

  <!-- MODAL TAMBAH USER -->
  <div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Tambah User Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <form action="proses/tambah_user.php" method="POST">
          <div class="modal-body">

            <label class="mt-2">NIM / ID Staff</label>
            <input type="text" name="nim" class="form-control" required>

            <label class="mt-2">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>

            <label class="mt-2">Password</label>
            <input type="text" name="password" class="form-control" required>

            <label class="mt-2">Role</label>
            <select name="role" class="form-select">
              <option value="admin">Admin</option>
              <option value="mahasiswa">Mahasiswa</option>
              <option value="staff">Staff</option>
            </select>

            <label class="mt-2">Status</label>
            <select name="status" class="form-select">
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary">Tambah User</button>
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
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
