<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
        <div>
            <a href="<?= base_url('absensi/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Absensi
            </a>
            <a href="<?= base_url('absensi/batch') ?>" class="btn btn-success">
                <i class="fas fa-users"></i> Input Batch
            </a>
        </div>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter"></i> Filter Data
            </h6>
        </div>
        <div class="card-body">
            <form method="get" action="<?= base_url('absensi') ?>" class="row">
                <div class="col-md-3 mb-3">
                    <label>Mata Kuliah</label>
                    <select name="matakuliah" class="form-control">
                        <option value="">Semua Mata Kuliah</option>
                        <?php foreach ($matakuliah as $mk): ?>
                            <option value="<?= $mk['id'] ?>" 
                                <?= (isset($filter_matakuliah) && $filter_matakuliah == $mk['id']) ? 'selected' : '' ?>>
                                <?= $mk['nama_mk'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Dosen</label>
                    <select name="dosen" class="form-control">
                        <option value="">Semua Dosen</option>
                        <?php foreach ($dosen as $dsn): ?>
                            <option value="<?= $dsn['id'] ?>" 
                                <?= (isset($filter_dosen) && $filter_dosen == $dsn['id']) ? 'selected' : '' ?>>
                                <?= $dsn['nama_dosen'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Tahun Akademik</label>
                    <input type="text" name="tahun" class="form-control" 
                           value="<?= $filter_tahun ?? '' ?>" 
                           placeholder="Contoh: 2025/2026">
                </div>
                <div class="col-md-3 mb-3">
                    <label>Semester</label>
                    <select name="semester" class="form-control">
                        <option value="">Semua Semester</option>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <option value="<?= $i ?>" 
                                <?= (isset($filter_semester) && $filter_semester == $i) ? 'selected' : '' ?>>
                                Semester <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                        
                        <!-- ✅ TOMBOL PRINT - SATU TEMPAT SAJA -->
                        <?php if (isset($totalData) && $totalData > 0): ?>
                        <a href="<?= base_url('absensi/print?' . http_build_query([
                            'matakuliah' => $filter_matakuliah ?? '',
                            'dosen' => $filter_dosen ?? '',
                            'tahun' => $filter_tahun ?? '',
                            'semester' => $filter_semester ?? ''
                        ])) ?>" 
                           class="btn btn-info ml-2" 
                           target="_blank">
                            <i class="fas fa-print"></i> Print Laporan
                        </a>
                        <?php endif; ?>
                        
                        <div class="ml-auto">
                            <span class="badge badge-info">
                                Total Data: <?= $totalData ?? 0 ?>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ✅ PENUTUPAN CARD FILTER YANG BENAR -->

    <!-- Pagination Info (DI ATAS TABEL) -->
    <?php if (isset($totalData) && $totalData > 0): ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="alert alert-light border-left-primary shadow-sm">
                <i class="fas fa-info-circle text-primary mr-2"></i>
                Menampilkan <strong><?= (($currentPage - 1) * $perPage) + 1 ?></strong> 
                sampai <strong><?= min($currentPage * $perPage, $totalData) ?></strong> 
                dari <strong><?= $totalData ?></strong> data
                <?php if (isset($filter_matakuliah) && $filter_matakuliah): ?>
                    <br><small class="text-muted">Filter: Mata Kuliah terpilih</small>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <nav aria-label="Page navigation" class="float-right">
                <ul class="pagination pagination-sm mb-0">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= base_url('absensi?page=' . ($currentPage - 1) . 
                                (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                            ) ?>">
                                <i class="fas fa-chevron-left"></i> Sebelumnya
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php 
                    $totalPages = ceil($totalData / $perPage);
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    // ✅ PERBAIKAN: ganti endforeach dengan endfor
                    for ($i = $startPage; $i <= $endPage; $i++): 
                    ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= base_url('absensi?page=' . $i . 
                                (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                            ) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?> <!-- ✅ INI YANG BENAR: endfor bukan endforeach -->
                    
                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= base_url('absensi?page=' . ($currentPage + 1) . 
                                (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                            ) ?>">
                                Berikutnya <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table"></i> Daftar Absensi
            </h6>
            <?php if (isset($totalData) && $totalData > 0): ?>
            <div class="text-muted small">
                Halaman <?= $currentPage ?> dari <?= ceil($totalData / $perPage) ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="50">No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Tanggal</th>
                            <th>Pertemuan</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($absensi)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                                    </div>
                                    <h5 class="text-gray-500">Belum ada data absensi</h5>
                                    <p class="mb-0">Mulai dengan <a href="<?= base_url('absensi/create') ?>">menambahkan absensi baru</a></p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php 
                            $startNumber = (($currentPage - 1) * $perPage) + 1;
                            $no = $startNumber;
                            ?>
                            <?php foreach ($absensi as $row): ?>
                                <?php 
                                // Tentukan badge status
                                $status_badge = '';
                                $status_text = '';
                                
                                switch ($row['status']) {
                                    case 'H':
                                        $status_badge = 'badge-success';
                                        $status_text = 'Hadir';
                                        break;
                                    case 'I':
                                        $status_badge = 'badge-warning';
                                        $status_text = 'Izin';
                                        break;
                                    case 'S':
                                        $status_badge = 'badge-info';
                                        $status_text = 'Sakit';
                                        break;
                                    case 'A':
                                        $status_badge = 'badge-danger';
                                        $status_text = 'Alpa';
                                        break;
                                    default:
                                        $status_badge = 'badge-secondary';
                                        $status_text = '-';
                                }
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <strong><?= $row['nama_mahasiswa'] ?></strong><br>
                                        <small class="text-muted">NIM: <?= $row['nim'] ?></small>
                                    </td>
                                    <td>
                                        <?= $row['nama_mk'] ?>
                                    </td>
                                    <td><?= $row['nama_dosen'] ?></td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($row['tgl_absen'])) ?><br>
                                        <small class="text-muted">T.A: <?= $row['tahun_akademik'] ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary">Pert. <?= $row['pertemuan_ke'] ?></span><br>
                                        <small class="text-muted">Sem. <?= $row['semester'] ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $status_badge ?>"><?= $status_text ?></span>
                                        <?php if (!empty($row['keterangan'])): ?>
                                            <br><small class="text-muted" title="<?= $row['keterangan'] ?>">
                                                <i class="fas fa-info-circle"></i>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="<?= base_url('absensi/edit/' . $row['id']) ?>" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('absensi/delete/' . $row['id']) ?>" 
                                               class="btn btn-danger" title="Hapus"
                                               onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Bawah (Opsional) -->
            <?php if (isset($totalData) && $totalData > 0): ?>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <div class="d-inline-block">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0 justify-content-center">
                                <?php if ($currentPage > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('absensi?page=' . ($currentPage - 1) . 
                                            (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                            (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                            (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                            (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                                        ) ?>">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= base_url('absensi?page=' . $i . 
                                            (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                            (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                            (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                            (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                                        ) ?>">
                                            <?= $i ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($currentPage < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('absensi?page=' . ($currentPage + 1) . 
                                            (isset($filter_matakuliah) && $filter_matakuliah ? '&matakuliah=' . $filter_matakuliah : '') .
                                            (isset($filter_dosen) && $filter_dosen ? '&dosen=' . $filter_dosen : '') .
                                            (isset($filter_tahun) && $filter_tahun ? '&tahun=' . $filter_tahun : '') .
                                            (isset($filter_semester) && $filter_semester ? '&semester=' . $filter_semester : '')
                                        ) ?>">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Stats -->
    <?php if (!empty($absensi)): ?>
    <div class="row">
        <?php 
        // Hitung statistik
        $total_hadir = 0;
        $total_izin = 0;
        $total_sakit = 0;
        $total_alpa = 0;
        
        foreach ($absensi as $row) {
            switch ($row['status']) {
                case 'H': $total_hadir++; break;
                case 'I': $total_izin++; break;
                case 'S': $total_sakit++; break;
                case 'A': $total_alpa++; break;
            }
        }
        ?>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Halaman Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($absensi) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Hadir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_hadir ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Izin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_izin ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Alpa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_alpa ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// DataTables untuk sorting & search (tanpa pagination)
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": false,        // Nonaktifkan pagination DataTables
        "searching": true,      // Aktifkan search
        "ordering": true,       // Aktifkan sorting
        "info": false,          // Nonaktifkan info
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "dom": '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6"l>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
    });
});
</script>

<style>
.table th {
    font-weight: 600;
}

.badge {
    font-size: 0.85em;
    padding: 0.35em 0.65em;
}

.card {
    border-radius: 0.35rem;
}

.alert {
    border-radius: 0.35rem;
    border: none;
}

.pagination .page-item.active .page-link {
    background-color: #4e73df;
    border-color: #4e73df;
}

.pagination .page-link {
    color: #4e73df;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    border-color: #ddd;
}

.alert-light {
    background-color: #f8f9fc;
    border-left: 4px solid #4e73df !important;
}

/* ✅ STYLE UNTUK TOMBOL PRINT */
.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
    color: white;
}

.d-flex .btn {
    margin-right: 5px;
}

/* Tombol Print khusus */
.btn-info i {
    margin-right: 5px;
}
</style>

<?= $this->endSection(); ?>