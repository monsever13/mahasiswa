<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="/krs/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah KRS</a>
            </div>
            
            <form action="" method="get">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari NIM/Nama..." value="<?= $keyword; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Tahun Akademik</th>
                            <th>Total SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (10 * ($pager->getCurrentPage('krs') - 1)); ?>
                        <?php foreach ($krs as $k) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $k['nim']; ?></td>
                                <td><?= $k['nama_mhs']; ?></td>
                                <td class="text-center">Smt <?= $k['semester']; ?></td>
                                <td><?= $k['tahun_akademik']; ?></td>
                                <td class="text-center"><?= $k['total_sks']; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/krs/edit/<?= $k['id']; ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        
                                        <a href="/krs/print_individu/<?= $k['id_mahasiswa']; ?>?smt=<?= $k['semester']; ?>&thn=<?= $k['tahun_akademik']; ?>" target="_blank" class="btn btn-info btn-sm" title="Cetak"><i class="fas fa-print"></i></a>
                                        
                                        <form action="/krs/delete/<?= $k['id']; ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus item ini?')">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('krs', 'bootstrap_pagination'); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>