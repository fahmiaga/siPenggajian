<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <div class="row">
        <h1 class="page-header">Form Tambah Data Pekerjaan</h1>
        <div class="container">

            <form class="col-sm-6" action="/lembur/save/<?= $id; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea type="text" name="deskripsi" class="form-control <?= ($validation->hasError('deskripsi') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="deskripsi" autofocus value="<?= old('deskripsi'); ?>"></textarea>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('deskripsi'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lama Lembur</label>
                    <input type="number" name="lama_lembur" class="form-control <?= ($validation->hasError('lama_lembur') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="lama lembur" autofocus value="<?= old('lama_lembur'); ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('lama_lembur'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>


    </div>
</div>
<?= $this->endSection(); ?>