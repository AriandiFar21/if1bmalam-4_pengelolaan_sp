<!-- Tombol Tambah User -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
    Tambah User
</button>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="tambah_user.php" method="POST">
        <div class="modal-body">

          <label>NIM / ID Staff</label>
          <input type="text" name="nim" class="form-control" required>

          <label class="mt-3">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" required>

          <label class="mt-3">Password</label>
          <input type="password" name="password" class="form-control" required>

          <label class="mt-3">Role</label>
          <select name="role" class="form-control" required>
              <option value="Admin">Admin</option>
              <option value="Dosen">Dosen</option>
              <option value="Mahasiswa">Mahasiswa</option>
          </select>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>
