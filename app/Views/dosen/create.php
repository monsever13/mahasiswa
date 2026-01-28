<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Tambah Dosen</div>
                <div class="card-body">
                    <form action="/dosen/store" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label>NIDN</label>
                            <input type="text" name="nidn" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Spesialisasi</label>
                            <input type="text" name="spesialisasi" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/dosen" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>