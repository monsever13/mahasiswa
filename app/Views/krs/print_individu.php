<!DOCTYPE html>
<html>
<head>
    <title>Cetak KRS - <?= $krs[0]['nama_mhs'] ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; padding: 30px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .info { margin-bottom: 15px; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>KARTU RENCANA STUDI (KRS)</h2>
        <h3>UNIVERSITAS STKIP</h3>
    </div>

    <div class="info">
        <p><strong>NIM :</strong> <?= $krs[0]['nim'] ?></p>
        <p><strong>Nama :</strong> <?= $krs[0]['nama_mhs'] ?></p>
        <p><strong>Tahun Akademik :</strong> <?= $krs[0]['tahun_akademik'] ?> (Semester <?= $krs[0]['semester'] ?>)</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_sks = 0; $no = 1; foreach($krs as $k) : 
                // Karena print individu, kita pecah kembali daftar_mk jika menggunakan Group_Concat
                // Namun karena query findAll() di atas tidak menjalankan GroupBy, data akan berderet rapi
                $total_sks += $k['sks'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nama_mk'] ?></td>
                <td><?= $k['sks'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total SKS</th>
                <th><?= $total_sks ?></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Pandeglang, <?= date('d M Y') ?></p>
        <br><br><br>
        <p>( ____________________ )</p>
        <p>Dosen Pembimbing Akademik</p>
    </div>
</body>
</html>