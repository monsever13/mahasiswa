<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Edit Absensi</h1>
        <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> <strong>Ada kesalahan:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="card shadow">
        <div class="card-header bg-warning text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-edit"></i> Form Edit Absensi
            </h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('absensi/update/' . $absensi['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Mahasiswa -->
                        <div class="form-group">
                            <label class="font-weight-bold">Mahasiswa <span class="text-danger">*</span></label>
                            <select name="id_mahasiswa" class="form-control" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                <?php foreach ($mahasiswa as $mhs): ?>
                                    <option value="<?= $mhs['id'] ?>" 
                                        <?= ($absensi['id_mahasiswa'] == $mhs['id']) ? 'selected' : '' ?>>
                                        <?= $mhs['nim'] ?> - <?= $mhs['nama'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Mata Kuliah -->
                        <div class="form-group">
                            <label class="font-weight-bold">Mata Kuliah <span class="text-danger">*</span></label>
                            <select name="id_matakuliah" class="form-control" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                <?php foreach ($matakuliah as $mk): ?>
                                    <option value="<?= $mk['id'] ?>" 
                                        <?= ($absensi['id_matakuliah'] == $mk['id']) ? 'selected' : '' ?>>
                                        <?= $mk['nama_mk'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Dosen -->
                        <div class="form-group">
                            <label class="font-weight-bold">Dosen <span class="text-danger">*</span></label>
                            <select name="id_dosen" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                <?php foreach ($dosen as $dsn): ?>
                                    <option value="<?= $dsn['id'] ?>" 
                                        <?= ($absensi['id_dosen'] == $dsn['id']) ? 'selected' : '' ?>>
                                        <?= $dsn['nama_dosen'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Tanggal Absen -->
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Absen <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_absen" class="form-control" 
                                   value="<?= $absensi['tgl_absen'] ?>" required>
                        </div>

                        <!-- Pertemuan Ke -->
                        <div class="form-group">
                            <label class="font-weight-bold">Pertemuan Ke <span class="text-danger">*</span></label>
                            <select name="pertemuan_ke" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php for ($i = 1; $i <= 16; $i++): ?>
                                    <option value="<?= $i ?>" 
                                        <?= ($absensi['pertemuan_ke'] == $i) ? 'selected' : '' ?>>
                                        Pertemuan <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_H" value="H" 
                                        <?= ($absensi['status'] == 'H') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-success" for="status_H">
                                        <i class="fas fa-check-circle"></i> Hadir
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_I" value="I"
                                        <?= ($absensi['status'] == 'I') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-warning" for="status_I">
                                        <i class="fas fa-clock"></i> Izin
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_S" value="S"
                                        <?= ($absensi['status'] == 'S') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-info" for="status_S">
                                        <i class="fas fa-procedures"></i> Sakit
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_A" value="A"
                                        <?= ($absensi['status'] == 'A') ? 'checked' : '' ?>>
                                    <label class="form-check-label text-danger" for="status_A">
                                        <i class="fas fa-times-circle"></i> Alpa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun & Semester -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Tahun Akademik</label>
                                    <input type="text" name="tahun_akademik" class="form-control" 
                                           value="<?= $absensi['tahun_akademik'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Semester</label>
                                    <select name="semester" class="form-control">
                                        <?php for ($i = 1; $i <= 8; $i++): ?>
                                            <option value="<?= $i ?>" 
                                                <?= ($absensi['semester'] == $i) ? 'selected' : '' ?>>
                                                Semester <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="form-group">
                    <label class="font-weight-bold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= $absensi['keterangan'] ?></textarea>
                </div>

                <!-- Info Data -->
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Info:</strong> Data dibuat pada <?= date('d/m/Y H:i', strtotime($absensi['created_at'])) ?>
                </div>

                <hr>

                <!-- Tombol -->
                <div class="text-right">
                    <a href="<?= base_url('absensi/delete/' . $absensi['id']) ?>" 
                       class="btn btn-danger mr-2"
                       onclick="return confirm('Yakin hapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Set focus ke field pertama
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('select[name="id_mahasiswa"]').focus();
});
</script>

<style>
.card {
    border-radius: 0.5rem;
}

.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.form-check-input:checked {
    background-color: #ffc107;
    border-color: #ffc107;
}

.bg-warning {
    background-color: #ffc107 !important;
}
</style>

<?= $this->endSection(); ?>