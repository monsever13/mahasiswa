<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | SIM Kampus Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4e73df;
            --dark-bg: #1a1c23;
        }

        body {
            background-color: #f8f9fc;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--dark-bg);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #111217;
            text-align: center;
        }

        #sidebar .nav-link {
            color: #949aaf;
            padding: 12px 25px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            text-decoration: none;
            transition: 0.2s;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--primary-color);
        }

        #sidebar i {
            width: 25px;
            font-size: 1.1rem;
        }

        /* Submenu / Dropdown Styling */
        .collapse-inner {
            background: rgba(0, 0, 0, 0.2);
            margin: 5px 15px;
            border-radius: 8px;
            padding: 5px 0;
        }

        .collapse-item {
            display: block;
            padding: 8px 45px;
            color: #949aaf !important;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .collapse-item:hover {
            color: #fff !important;
            padding-left: 50px;
        }

        /* Content Styling */
        #main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 25px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar { left: -260px; }
            #main-content { margin-left: 0; width: 100%; }
            #sidebar.active { left: 0; }
        }
    </style>
</head>
<body>

<nav id="sidebar">
    <div class="sidebar-header">
        <h5 class="m-0 fw-bold"><i class="fas fa-university me-2 text-primary"></i> SIM KAMPUS</h5>
    </div>
    
    <div class="mt-4">
        <small class="text-uppercase px-4 text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">Menu Utama</small>
        
        <a href="<?= base_url('/'); ?>" class="nav-link <?= (uri_string() == '' || uri_string() == '/') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <a href="<?= base_url('mahasiswa'); ?>" class="nav-link <?= (url_is('mahasiswa*')) ? 'active' : ''; ?>">
            <i class="fas fa-user-graduate"></i> Data Mahasiswa
        </a>
        
        <a href="<?= base_url('dosen'); ?>" class="nav-link <?= (url_is('dosen*')) ? 'active' : ''; ?>">
            <i class="fas fa-chalkboard-teacher"></i> Data Dosen
        </a>

        <a href="<?= base_url('matakuliah'); ?>" class="nav-link <?= (url_is('matakuliah*')) ? 'active' : ''; ?>">
            <i class="fas fa-book"></i> Mata Kuliah
        </a>

        <li class="nav-item">
    <a class="nav-link" href="<?= base_url('krs'); ?>">
        <i class="fas fa-fw fa-id-card"></i>
        <span>Kartu Rencana Studi (KRS)</span>
    </a>

    <li class="nav-item">
    <a class="nav-link" href="<?= base_url('khs'); ?>">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Kartu Hasil Studi (KHS)</span>
    </a>
</li>
</li>
</nav>

<main id="main-content">
    <div class="top-navbar d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-gray-800 fw-bold"><?= $title; ?></h5>
        <div class="user-info d-flex align-items-center">
            <div class="text-end me-3">
                <div class="fw-bold small">Administrator</div>
                <div class="text-muted small" style="font-size: 11px;">Online</div>
            </div>
            <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" class="rounded-circle border" width="35">
        </div>
    </div>

    <div class="container-fluid px-4 pb-5">
        <?= $this->renderSection('content'); ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Opsional: Jika Anda ingin menambahkan button toggle nantinya
    // document.getElementById('sidebarCollapse').addEventListener('click', function() {
    //     document.getElementById('sidebar').classList.toggle('active');
    // });
</script>

</body>
</html>