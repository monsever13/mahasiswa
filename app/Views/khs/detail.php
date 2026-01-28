<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow p-4">
        <h4>Input Nilai: <?= $mahasiswa['nama_mhs'] ?></h4>
        <p class="text-muted">NIM: <?= $mahasiswa['nim'] ?> | Semester: <?= $mahasiswa['semester'] ?></p>
        
        <table class="table table-bordered mt-3">
            <thead class="bg-light">
                <tr>
                    <th>Mata Kuliah</th>
                    <th width="150">Nilai (0-100)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($matakuliah as $mk) : ?>
                <tr>
                    <td><?= $mk['nama_mk'] ?></td>
                    <form action="/khs/update/<?= $mk['id'] ?>" method="post">
                        <td>
                            <input type="number" name="nilai_angka" class="form-control" value="<?= $mk['nilai_angka'] ?>" min="0" max="100">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="/khs" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-6">
        <form action="/khs/update_info/<?= $mahasiswa['id_mahasiswa'] ?>" method="post" class="card p-3 shadow-sm">
            <h6>Edit Info Akademik</h6>
            <div class="d-flex gap-2">
                <input type="text" name="tahun_akademik" class="form-control form-control-sm" value="<?= $mahasiswa['tahun_akademik'] ?>" placeholder="Tahun Akademik">
                <select name="semester" class="form-control form-control-sm">
                    <option value="1" <?= ($mahasiswa['semester'] == '1') ? 'selected' : '' ?>>Sem 1</option>
                    <option value="2" <?= ($mahasiswa['semester'] == '2') ? 'selected' : '' ?>>Sem 2</option>
                    </select>
                <button type="submit" class="btn btn-sm btn-info">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>