<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <div class="row">
        <h1 class="page-header">Ubah Data Pekerjaan</h1>
        <div class="container">

            <form class="col-sm-6" action="/pekerjaan/update/<?= $pekerjaan['id_pekerjaan']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pekerjaan</label>
                    <input type="text" name="nama_pekerjaan" class="form-control <?= ($validation->hasError('nama_pekerjaan') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="Nama Pekerjaan" autofocus value="<?= (old('nama_pekerjaan')) ? old('nama_pekerjaan') : $pekerjaan['nama_pekerjaan'] ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama_pekerjaan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gaji</label>
                    <input type="text" name="gaji" class="form-control <?= ($validation->hasError('gaji') ? 'is-invalid' : ''); ?>" id="exampleInputPassword1" placeholder="Gaji" value="<?= (old('gaji')) ? old('gaji') : $pekerjaan['gaji'] ?>">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('gaji'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>


    </div>
</div>
<?= $this->endSection(); ?>