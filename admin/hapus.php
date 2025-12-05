<a href="#" 
   class="btn btn-danger btn-sm" 
   data-bs-toggle="modal"
   data-bs-target="#modalHapus<?= $row['nim']; ?>">
    Hapus
</a>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="modalHapus<?= $row['nim']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    Yakin ingin menghapus user 
                    <b>"<?= $row['nama_lengkap']; ?>"</b> 
                    (<?= $row['nim']; ?>)?
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                <a href="hapus_user.php?nim=<?= $row['nim']; ?>" 
                   class="btn btn-danger">
                    Hapus
                </a>
            </div>

        </div>
    </div>
</div>
