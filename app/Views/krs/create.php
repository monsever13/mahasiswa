<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah KRS Baru</h6>
        </div>
        <div class="card-body">
            <form action="/krs/store" method="post">
                <?= csrf_field(); ?>
                <div class="form-group mb-3">
                    <label>Mahasiswa</label>
                    <select name="id_mahasiswa" class="form-control" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php foreach ($mahasiswa as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['nim']; ?> - <?= $m['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                                <option value="<?= $i; ?>">Semester <?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" class="form-control" placeholder="2025/2026" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Pilih Mata Kuliah</label>
                    <div class="table-responsive border p-3" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-sm">
                            <?php foreach ($matakuliah as $mk) : ?>
                                <tr>
                                    <td width="30"><input type="checkbox" name="id_mk[]" value="<?= $mk['id']; ?>"></td>
                                    <td><?= $mk['nama_mk']; ?> (<?= $mk['sks']; ?> SKS)</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan KRS</button>
                <a href="/krs" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>