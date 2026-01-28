<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="/krs" class="btn btn-secondary btn-sm shadow-sm"> Kembali ke Daftar</a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('pesan'); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body bg-light">
            <form action="/krs/update_info" method="post" class="row align-items-end">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_mahasiswa" value="<?= $krs['id_mahasiswa']; ?>">
                <input type="hidden" name="semester_lama" value="<?= $krs['semester']; ?>">
                <input type="hidden" name="tahun_lama" value="<?= $krs['tahun_akademik']; ?>">
                
                <div class="col-md-4">
                    <label class="small font-weight-bold">Update Semester</label>
                    <input type="number" name="semester" class="form-control" value="<?= $krs['semester']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="small font-weight-bold">Update Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" class="form-control" value="<?= $krs['tahun_akademik']; ?>" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-dark shadow-sm px-4">Simpan Perubahan Identitas</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Tambah Mata Kuliah</h6></div>
                <div class="card-body">
                    <form action="/krs/add_item" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_mahasiswa" value="<?= $krs['id_mahasiswa']; ?>">
                        <input type="hidden" name="semester" value="<?= $krs['semester']; ?>">
                        <input type="hidden" name="tahun_akademik" value="<?= $krs['tahun_akademik']; ?>">

                        <div class="form-group mb-3">
                            <label>Pilih Mata Kuliah</label>
                            <select name="id_matakuliah" class="form-control select2" required>
                                <option value="">-- Cari MK --</option>
                                <?php foreach ($matakuliah as $mk) : ?>
                                    <option value="<?= $mk['id']; ?>"><?= $mk['nama_mk']; ?> (<?= $mk['sks']; ?> SKS)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> Tambah ke Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; foreach ($daftar_mk as $row) : $total += $row['sks']; ?>
                                    <tr>
                                        <td><?= $row['nama_mk']; ?></td>
                                        <td class="text-center"><?= $row['sks']; ?></td>
                                        <td class="text-center">
                                            <form action="/krs/delete/<?= $row['id']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus MK?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tr class="font-weight-bold">
                                <td class="text-right">Total SKS:</td>
                                <td class="text-center bg-yellow-100"><?= $total; ?></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>