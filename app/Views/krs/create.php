<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Input KRS Mahasiswa</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('krs/store'); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">Pilih Mahasiswa</label>
                        <select name="id_mahasiswa" class="form-control" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach ($mahasiswa as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['nim']; ?> - <?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
    <label>Semester</label>
    <select name="semester" class="form-control">
        <option value="1">1 (Satu)</option>
        <option value="2">2 (Dua)</option>
        <option value="3">3 (Tiga)</option>
        <option value="4">4 (Empat)</option>
        <option value="5">5 (Lima)</option>
        <option value="6">6 (Enam)</option>
        <option value="7">7 (Tujuh)</option>
        <option value="8">8 (Delapan)</option>
                                
        </select>
</div>
<div class="form-group">
    <label>Tahun Akademik</label>
    <input type="text" name="tahun_akademik" class="form-control" placeholder="Contoh: 2024/2025">
</div>
                </div>

                <label class="form-label font-weight-bold">Pilih Mata Kuliah (Bisa pilih lebih dari satu):</label>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th width="50px" class="text-center">Pilih</th>
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($matakuliah as $mk) : ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="id_mk[]" value="<?= $mk['id']; ?>">
                                </td>
                                <td><?= $mk['kode_mk']; ?></td>
                                <td><?= $mk['nama_mk']; ?></td>
                                <td><?= $mk['sks']; ?></td>
                                <td><?= $mk['nama_dosen']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary px-4">Simpan KRS</button>
                    <a href="<?= base_url('krs'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>