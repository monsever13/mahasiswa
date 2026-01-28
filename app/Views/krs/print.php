<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan KRS</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body onload="window.print()">
    <h2>LAPORAN KRS MAHASISWA</h2>
    <table>
        <thead>
            <tr><th>NIM</th><th>Nama</th><th>Mata Kuliah</th><th>SKS</th><th>Dosen</th></tr>
        </thead>
        <tbody>
            <?php foreach($krs as $k) : ?>
            <tr>
                <td><?= $k['nim'] ?></td><td><?= $k['nama_mhs'] ?></td>
                <td><?= $k['nama_mk'] ?></td><td><?= $k['sks'] ?></td>
                <td><?= $k['nama_dosen'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>