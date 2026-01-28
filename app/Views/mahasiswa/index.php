<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <form action="" method="get" id="formFilter">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <select name="perPage" class="form-select form-select-sm" onchange="document.getElementById('formFilter').submit()">
                        <option value="5" <?= $perPage == 5 ? 'selected' : ''; ?>>5</option>
                        <option value="10" <?= $perPage == 10 ? 'selected' : ''; ?>>10</option>
                        <option value="25" <?= $perPage == 25 ? 'selected' : ''; ?>>25</option>
                        <option value="50" <?= $perPage == 50 ? 'selected' : ''; ?>>50</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="small text-muted">data per halaman</label>
                </div>
                <div class="col"></div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= $search; ?>">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Logika penomoran agar tetap urut meski ganti halaman
                $no = 1 + ($perPage * ($page - 1)); 
                foreach($mahasiswa as $m) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $m['nim']; ?></td>
                    <td><?= $m['nama']; ?></td>
                    <td>
                        <a href="/mahasiswa/edit/<?= $m['id']; ?>" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="small text-muted">
                Menampilkan <?= count($mahasiswa); ?> data.
            </div>
            <div>
                <?= $pager->links('mahasiswa', 'bootstrap_pagination'); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>