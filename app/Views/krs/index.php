<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card p-4 shadow">
    <div class="d-flex justify-content-between mb-3">
        <form action="" method="get" class="d-flex col-md-4">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Cari..." value="<?= $keyword ?>">
            <button class="btn btn-primary">Cari</button>
        </form>
        <div>
            <a href="/krs/print" target="_blank" class="btn btn-success">Print Laporan</a>
            <a href="/krs/create" class="btn btn-primary">Tambah KRS</a>
        </div>
    </div>
 <table class="table table-bordered">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester / Tahun</th>
            <th>Mata Kuliah Diambil</th>
            <th>Total SKS</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($krs as $k) : ?>
        <tr>
            <td><?= $k['nim'] ?></td>
            <td><strong><?= $k['nama_mhs'] ?></strong></td>
            <td><?= $k['semester'] ?> (<?= $k['tahun_akademik'] ?>)</td>
            <td><small><?= $k['daftar_mk'] ?></small></td>
            <td class="text-center"><?= $k['total_sks'] ?></td>
            <td>
                <div class="d-flex gap-1">
                    <form action="/krs/delete/<?= $k['id_mahasiswa'] ?>" method="post" onsubmit="return confirm('Hapus semua mata kuliah mahasiswa ini di semester terkait?')">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                    
                    <a href="/krs/print_individu/<?= $k['id_mahasiswa'] ?>" target="_blank" class="btn btn-sm btn-info">Cetak</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <div class="mt-3"><?= $pager->links('krs', 'bootstrap_pagination') ?></div>
</div>
<?= $this->endSection(); ?>