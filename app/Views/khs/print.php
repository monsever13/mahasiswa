<!DOCTYPE html>
<html>
<head>
    <title>KHS_<?= $result[0]['nim'] ?></title>
    <style>
        body { font-family: Arial; font-size: 12px; margin: 40px; line-height: 1.6; }
        .tabel-khs { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .tabel-khs th, .tabel-khs td { border: 1px solid black; padding: 8px; text-align: center; }
        .header { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .footer { margin-top: 30px; float: right; text-align: center; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        KARTU HASIL STUDI (KHS) SEMESTER GENAP<br>
        Tahun Akademik <?= $result[0]['tahun_akademik'] ?>
    </div>
    
    <table style="width: 100%; margin-bottom: 10px;">
        <tr><td width="15%">Nama</td><td>: <?= $result[0]['nama_mhs'] ?></td></tr>
        <tr><td>NIM</td><td>: <?= $result[0]['nim'] ?></td></tr>
        <tr><td>Semester</td><td>: <?= $result[0]['semester'] ?></td></tr>
        <tr><td>Prodi</td><td>: S1 / PTI</td></tr>
    </table>

    <table class="tabel-khs">
        <thead>
            <tr class="bg-light">
                <th>No</th><th>Kode</th><th>Mata Kuliah</th><th>Nilai</th><th>Bobot (N)</th><th>SKS (K)</th><th>Mutu (KxN)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $t_sks = 0; $t_mutu = 0; $no = 1;
            foreach($result as $r) : 
                $n = $r['nilai_angka'];
                if($n >= 80) { $h = 'A'; $b = 4; }
                elseif($n >= 70) { $h = 'B'; $b = 3; }
                elseif($n >= 60) { $h = 'C'; $b = 2; }
                elseif($n >= 50) { $h = 'D'; $b = 1; }
                else { $h = 'E'; $b = 0; }
                
                $mutu = $r['sks'] * $b;
                $t_sks += $r['sks'];
                $t_mutu += $mutu;
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r['kode_mk'] ?></td>
                <td style="text-align: left;"><?= $r['nama_mk'] ?></td>
                <td><?= $h ?></td>
                <td><?= $b ?></td>
                <td><?= $r['sks'] ?></td>
                <td><?= $mutu ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tr style="font-weight: bold;">
            <td colspan="5">Jumlah</td><td><?= $t_sks ?></td><td><?= $t_mutu ?></td>
        </tr>
    </table>

    <p><strong>Indeks Prestasi Komulatif (IPK): <?= number_format($t_mutu / $t_sks, 2) ?></strong></p>

    <div class="footer">
        Pandeglang, <?= date('d F Y') ?><br>Ketua Prodi,<br><br><br><br>
        ( ____________________ )
    </div>
</body>
</html>