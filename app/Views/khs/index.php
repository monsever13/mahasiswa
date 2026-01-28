<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Kartu Hasil Studi (KHS)</h1>
    <div class="card shadow p-4">
        <form action="" method="get" class="mb-3 d-flex col-md-4">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Cari Nama/NIM..." value="<?= $keyword ?>">
            <button class="btn btn-primary">Cari</button>
        </form>
        <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th class="text-center">Jumlah MK</th>
            <th class="text-center">Total SKS</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($khs as $k) : ?>
        <tr>
            <td><?= $k['nim'] ?></td>
            <td><strong><?= $k['nama_mhs'] ?></strong></td>
            <td><?= $k['semester'] ?> (<?= $k['tahun_akademik'] ?>)</td>
            <td class="text-center"><?= $k['total_mk'] ?> MK</td>
            <td class="text-center"><?= $k['total_sks'] ?></td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <a href="/khs/detail/<?= $k['id_mahasiswa'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Input Nilai
                    </a>
                    <a href="/khs/print/<?= $k['id_mahasiswa'] ?>" target="_blank" class="btn btn-sm btn-success">
                        <i class="fas fa-print"></i> Cetak KHS
                    </a>
                    <form action="/khs/delete/<?= $k['id_mahasiswa'] ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data KHS/KRS mahasiswa ini di semester tersebut?')">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        <?= $pager->links('khs', 'bootstrap_pagination') ?>
    </div>
</div>
<?= $this->endSection(); ?>