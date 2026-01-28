<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Dosen</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('dosen/update/' . $dosen['id']); ?>" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">NIDN</label>
                            <input type="text" name="nidn" class="form-control" value="<?= $dosen['nidn']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" value="<?= $dosen['nama_dosen']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $dosen['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Spesialisasi</label>
                            <input type="text" name="spesialisasi" class="form-control" value="<?= $dosen['spesialisasi']; ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('dosen'); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>