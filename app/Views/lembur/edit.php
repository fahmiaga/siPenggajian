<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <div class="row">
        <h1 class="page-header">Form Ubah Lembur Karyawan</h1>
        <div class="container">

            <form class="col-sm-6" action="/lembur/update/<?= $lembur['id_lembur']; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_tanggal" value="<?= $lembur['id_tanggal']; ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Lembur Gaji</label>
                    <input type="text" name="deskripsi" class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="deskripsi Gaji" autofocus value="<?= $lembur['deskripsi']; ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('deskripsi'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lama Lembur</label>
                    <input type="number" name="lama_lembur" class="form-control <?= ($validation->hasError('lama_lembur') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="lama_lembur Gaji" autofocus value="<?= $lembur['lama_lembur']; ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('lama_lembur'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>


    </div>
</div>
<?= $this->endSection(); ?>