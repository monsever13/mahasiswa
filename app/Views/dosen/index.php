<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <form action="" method="get" id="formFilterDosen">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <select name="perPage" class="form-select form-select-sm" onchange="document.getElementById('formFilterDosen').submit()">
                        <option value="5" <?= $perPage == 5 ? 'selected' : ''; ?>>5</option>
                        <option value="10" <?= $perPage == 10 ? 'selected' : ''; ?>>10</option>
                        <option value="25" <?= $perPage == 25 ? 'selected' : ''; ?>>25</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="small text-muted">baris per halaman</label>
                </div>
                <div class="col"></div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari dosen..." value="<?= $search; ?>">
                        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Spesialisasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1 + ($perPage * ($page - 1)); 
                    foreach($dosen as $d) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><span class="badge bg-light text-dark border"><?= $d['nidn']; ?></span></td>
                        <td class="fw-bold"><?= $d['nama_dosen']; ?></td>
                        <td><?= $d['spesialisasi']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('dosen/edit/' . $d['id']); ?>" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('dosen/delete/' . $d['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="small text-muted">
                Menampilkan <?= count($dosen); ?> data dosen.
            </div>
            <div>
                <?= $pager->links('dosen', 'bootstrap_pagination'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>