<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow col-md-6 p-4">
        <h5>Input Nilai: <?= $row['nama_mhs'] ?></h5>
        <p><?= $row['kode_mk'] ?> - <?= $row['nama_mk'] ?></p>
        <form action="/khs/update/<?= $row['id'] ?>" method="post">
            <div class="form-group mb-3">
                <label>Nilai Angka (0-100)</label>
                <input type="number" name="nilai_angka" class="form-control" value="<?= $row['nilai_angka'] ?>" required>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="/khs" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>