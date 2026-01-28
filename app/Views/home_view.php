<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 border-0 border-start border-primary border-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mahasiswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mhs; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 border-0 border-start border-success border-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Dosen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_dsn; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 border-0 border-start border-info border-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mata Kuliah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mk; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 border-0 border-start border-warning border-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Rekap Absensi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-0">
                <div class="card-body p-5">
                    <h2 class="text-primary fw-bold">Selamat Datang, Admin!</h2>
                    <p class="lead">Sistem Informasi Akademik & Absensi TA. 2025/2026</p>
                    <hr>
                    <p>Melalui panel ini, Anda dapat mengelola data master mahasiswa, dosen, mata kuliah, serta mencetak laporan absensi sesuai format yang telah ditentukan.</p>
                    <div class="mt-4">
                        <a href="/absensi/create" class="btn btn-primary px-4 py-2 me-2">Input Absensi Baru</a>
                        <a href="/absensi" class="btn btn-outline-primary px-4 py-2">Lihat Laporan</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Informasi Sistem</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between">Versi Aplikasi <span>1.0.0-Beta</span></li>
                        <li class="list-group-item d-flex justify-content-between">Framework <span>CodeIgniter 4.5</span></li>
                        <li class="list-group-item d-flex justify-content-between">Server Time <span><?= date('H:i d M Y'); ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary { border-left: .25rem solid #4e73df!important; }
    .border-left-success { border-left: .25rem solid #1cc88a!important; }
    .border-left-info { border-left: .25rem solid #36b9cc!important; }
    .border-left-warning { border-left: .25rem solid #f6c23e!important; }
</style>
<?= $this->endSection(); ?>