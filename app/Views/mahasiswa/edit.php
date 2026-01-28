<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0 text-dark">Form Edit Mahasiswa</h5>
                    </div>
                    <div class="card-body">
                        <form action="/mahasiswa/update/<?= $mhs['id']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" value="<?= $mhs['nim']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= $mhs['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control" value="<?= $mhs['jurusan']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $mhs['email']; ?>">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="/mahasiswa" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-warning text-dark">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>