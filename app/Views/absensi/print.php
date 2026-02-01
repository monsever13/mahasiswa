<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                color: #000;
                background: #fff;
                margin: 0;
                padding: 20px;
            }
            
            .container {
                width: 100%;
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                page-break-inside: auto;
            }
            
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            
            thead {
                display: table-header-group;
            }
            
            tfoot {
                display: table-footer-group;
            }
            
            .page-break {
                page-break-before: always;
            }
            
            .text-center {
                text-align: center;
            }
            
            .text-right {
                text-align: right;
            }
            
            .bold {
                font-weight: bold;
            }
            
            .border-all {
                border: 1px solid #000;
            }
        }
        
        /* Screen Styles */
        @media screen {
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                background: #f8f9fa;
                padding: 20px;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            
            .no-print {
                margin-bottom: 20px;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 5px;
                border: 1px solid #dee2e6;
            }
        }
        
        /* Common Styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        
        .header p {
            margin: 5px 0;
            color: #666;
        }
        
        .filter-info {
            background: #f8f9fa;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th {
            background-color: #343a40;
            color: white;
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #454d55;
        }
        
        table td {
            padding: 6px 10px;
            border: 1px solid #dee2e6;
        }
        
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 3px;
        }
        
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: black; }
        .badge-info { background: #17a2b8; color: white; }
        .badge-danger { background: #dc3545; color: white; }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        
        .signature div {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!-- Print Control (only visible on screen) -->
    <div class="no-print">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <button onclick="window.print()" class="btn-print" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                <button onclick="window.close()" class="btn-close" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
            <div style="color: #666; font-size: 14px;">
                <i class="fas fa-info-circle"></i> Jumlah Data: <?= $total_data ?>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>LAPORAN ABSENSI MAHASISWA</h1>
            <p>Sistem Informasi Akademik</p>
            <p>Tanggal Cetak: <?= $print_date ?></p>
        </div>
        
        <!-- Filter Info -->
        <?php if (!empty($filter_details) || $filter_tahun || $filter_semester): ?>
        <div class="filter-info">
            <h4 style="margin-top: 0; margin-bottom: 10px; font-size: 16px;">Filter Data:</h4>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <?php if (isset($filter_details['matakuliah'])): ?>
                <div>
                    <strong>Mata Kuliah:</strong> <?= $filter_details['matakuliah'] ?>
                </div>
                <?php endif; ?>
                
                <?php if (isset($filter_details['dosen'])): ?>
                <div>
                    <strong>Dosen:</strong> <?= $filter_details['dosen'] ?>
                </div>
                <?php endif; ?>
                
                <?php if ($filter_tahun): ?>
                <div>
                    <strong>Tahun Akademik:</strong> <?= $filter_tahun ?>
                </div>
                <?php endif; ?>
                
                <?php if ($filter_semester): ?>
                <div>
                    <strong>Semester:</strong> <?= $filter_semester ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Summary -->
        <div style="margin-bottom: 15px; padding: 10px; background: #e9ecef; border-radius: 4px;">
            <strong>Total Data:</strong> <?= $total_data ?> record
        </div>
        
        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th width="80">Tanggal</th>
                    <th width="70">Pertemuan</th>
                    <th width="60">Status</th>
                    <th width="100">T.Akademik</th>
                    <th width="60">Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($absensi)): ?>
                    <tr>
                        <td colspan="10" class="text-center" style="padding: 20px; color: #999;">
                            Tidak ada data absensi
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; ?>
                    <?php foreach ($absensi as $row): ?>
                        <?php 
                        // Tentukan badge status
                        switch ($row['status']) {
                            case 'H': $status_class = 'badge-success'; $status_text = 'H'; break;
                            case 'I': $status_class = 'badge-warning'; $status_text = 'I'; break;
                            case 'S': $status_class = 'badge-info'; $status_text = 'S'; break;
                            case 'A': $status_class = 'badge-danger'; $status_text = 'A'; break;
                            default: $status_class = 'badge-secondary'; $status_text = '-';
                        }
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row['nim'] ?></td>
                            <td><?= $row['nama_mahasiswa'] ?></td>
                            <td><?= $row['nama_mk'] ?></td>
                            <td><?= $row['nama_dosen'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tgl_absen'])) ?></td>
                            <td class="text-center"><?= $row['pertemuan_ke'] ?></td>
                            <td class="text-center">
                                <span class="badge <?= $status_class ?>"><?= $status_text ?></span>
                            </td>
                            <td><?= $row['tahun_akademik'] ?></td>
                            <td class="text-center"><?= $row['semester'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Legend -->
        <div style="margin-top: 20px; padding: 10px; border: 1px solid #dee2e6; border-radius: 4px; font-size: 12px;">
            <strong>Keterangan Status:</strong>
            <span style="margin-left: 10px;"><span class="badge badge-success">H</span> = Hadir</span>
            <span style="margin-left: 10px;"><span class="badge badge-warning">I</span> = Izin</span>
            <span style="margin-left: 10px;"><span class="badge badge-info">S</span> = Sakit</span>
            <span style="margin-left: 10px;"><span class="badge badge-danger">A</span> = Alpa</span>
        </div>
        
        <!-- Signature -->
        <div class="signature">
            <div>
                <?= date('d F Y') ?>
            </div>
            <div>
                _________________________<br>
                Petugas
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Dicetak dari Sistem Absensi Mahasiswa &copy; <?= date('Y') ?></p>
            <p>Halaman 1 dari 1</p>
        </div>
    </div>
    
    <!-- JavaScript untuk print -->
    <script>
        // Auto print saat halaman load (opsional)
        // window.onload = function() {
        //     window.print();
        // };
        
        // Jika mau auto print, uncomment di atas
        
        // Keyboard shortcut Ctrl+P
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
        
        // Style untuk tombol (jika pakai font awesome)
        if (!document.querySelector('link[href*="font-awesome"]')) {
            var fa = document.createElement('link');
            fa.rel = 'stylesheet';
            fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
            document.head.appendChild(fa);
        }
    </script>
</body>
</html>