<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Tambah Absensi</h1>
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
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle"></i> Form Input Absensi
            </h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('absensi/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <!-- Mahasiswa -->
                        <div class="form-group">
                            <label class="font-weight-bold">Mahasiswa <span class="text-danger">*</span></label>
                            <select name="id_mahasiswa" class="form-control" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                <?php foreach ($mahasiswa as $mhs): ?>
                                    <option value="<?= $mhs['id'] ?>">
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
                                    <option value="<?= $mk['id'] ?>">
                                        <?= $mk['kode_mk'] ?> - <?= $mk['nama_mk'] ?>
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
                                    <option value="<?= $dsn['id'] ?>">
                                        <?= $dsn['nama_dosen'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Tanggal Absen -->
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Absen <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_absen" class="form-control" 
                                   value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <!-- Pertemuan Ke -->
                        <div class="form-group">
                            <label class="font-weight-bold">Pertemuan Ke <span class="text-danger">*</span></label>
                            <select name="pertemuan_ke" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php for ($i = 1; $i <= 16; $i++): ?>
                                    <option value="<?= $i ?>">Pertemuan <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_H" value="H" checked>
                                    <label class="form-check-label text-success" for="status_H">
                                        <i class="fas fa-check-circle"></i> Hadir
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_I" value="I">
                                    <label class="form-check-label text-warning" for="status_I">
                                        <i class="fas fa-clock"></i> Izin
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_S" value="S">
                                    <label class="form-check-label text-info" for="status_S">
                                        <i class="fas fa-procedures"></i> Sakit
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_A" value="A">
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
                                           value="2025/2026">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Semester</label>
                                    <select name="semester" class="form-control">
                                        <?php for ($i = 1; $i <= 8; $i++): ?>
                                            <option value="<?= $i ?>" <?= $i == 7 ? 'selected' : '' ?>>
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
                    <label class="font-weight-bold">Keterangan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="2" 
                              placeholder="Tambahkan keterangan jika perlu..."></textarea>
                </div>

                <hr>

                <!-- Tombol -->
                <div class="text-right">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="card shadow mt-4 border-left-info">
        <div class="card-body">
            <h6><i class="fas fa-info-circle text-info"></i> Informasi:</h6>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><span class="badge badge-success">H</span> = Hadir</p>
                    <p class="mb-1"><span class="badge badge-warning">I</span> = Izin</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><span class="badge badge-info">S</span> = Sakit</p>
                    <p class="mb-1"><span class="badge badge-danger">A</span> = Alpa</p>
                </div>
            </div>
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
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.form-check-input:checked {
    background-color: #4e73df;
    border-color: #4e73df;
}

.badge {
    font-size: 0.8em;
    padding: 0.35em 0.65em;
}
</style>

<?= $this->endSection(); ?>