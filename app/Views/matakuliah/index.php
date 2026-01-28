<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Mata Kuliah</h6>
        
        <form action="" method="get" class="d-flex">
            <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari MK atau Dosen..." value="<?= $keyword; ?>">
            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
        </form>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($matakuliah)) : ?>
                        <tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>
                    <?php endif; ?>
                    
                    <?php foreach ($matakuliah as $m) : ?>
                    <tr>
                        <td><?= $m['kode_mk']; ?></td>
                        <td><?= $m['nama_mk']; ?></td>
                        <td><?= $m['sks']; ?></td>
                        <td><?= $m['nama_dosen']; ?></td>
                        <td>
                            <a href="/matakuliah/edit/<?= $m['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('matakuliah/delete/' . $m['id']); ?>" 
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah [<?= $m['nama_mk']; ?>]?');">
                   <i class="fas fa-trash"></i> Hapus
                </a>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            <?= $pager->links('matakuliah', 'bootstrap_pagination') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>