<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card shadow p-4 col-md-8">
    <form action="/krs/update/<?= $krs['id']; ?>" method="post">
        <?= csrf_field(); ?>
        
        <div class="mb-3">
            <label>Mahasiswa</label>
            <select name="id_mahasiswa" class="form-control">
                <?php foreach($mahasiswa as $m) : ?>
                    <option value="<?= $m['id']; ?>" <?= ($m['id'] == $krs['id_mahasiswa']) ? 'selected' : ''; ?>>
                        <?= $m['nim']; ?> - <?= $m['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="id_matakuliah" class="form-control">
                <?php foreach($matakuliah as $mk) : ?>
                    <option value="<?= $mk['id']; ?>" <?= ($mk['id'] == $krs['id_matakuliah']) ? 'selected' : ''; ?>>
                        <?= $mk['kode_mk']; ?> - <?= $mk['nama_mk']; ?> (<?= $mk['sks']; ?> SKS)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Semester</label>
                <input type="text" name="semester" class="form-control" value="<?= $krs['semester']; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Tahun Akademik</label>
                <input type="text" name="tahun_akademik" class="form-control" value="<?= $krs['tahun_akademik']; ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="/krs" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection(); ?>