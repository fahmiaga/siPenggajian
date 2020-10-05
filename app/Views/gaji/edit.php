<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <div class="row">
        <h1 class="page-header">Form Ubah Data Tanggal</h1>
        <div class="container">

            <form class="col-sm-6" action="/gaji/update/<?= $tanggal['id_tanggal']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Gaji</label>
                    <input type="date" name="tanggal" class="form-control <?= ($validation->hasError('tanggal') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="Tanggal Gaji" autofocus value="<?= $tanggal['tanggal']; ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>


    </div>
</div>
<?= $this->endSection(); ?>