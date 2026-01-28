<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card shadow col-md-8">
    <div class="card-body">
        <form action="/matakuliah/store" method="post">
            <div class="mb-3">
                <label>Kode MK</label>
                <input type="text" name="kode_mk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>SKS</label>
                <input type="number" name="sks" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Dosen Pengampu</label>
                <select name="id_dosen" class="form-select" required>
                    <option value="">-- Pilih Dosen --</option>
                    <?php foreach ($dosen as $d) : ?>
                        <option value="<?= $d['id']; ?>"><?= $d['nama_dosen']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>