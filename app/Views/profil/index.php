<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <div class="row">
        <h1 class="page-header">Form Ubah Password</h1>
        <div class="container">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <?= session()->getFlashdata('pesan'); ?>
            <?php endif; ?>
            <form class="col-sm-6" action="/profil/update/<?= session()->get('id_karyawan'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Lama</label>
                    <input type="password" name="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="Password Lama" autofocus>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Baru</label>
                    <input type="password" name="password_baru" class="form-control <?= ($validation->hasError('password_baru') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="Password Baru" autofocus>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('password_baru'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Konfirmasi</label>
                    <input type="password" name="password_konfirmasi" class="form-control <?= ($validation->hasError('password_konfirmasi') ? 'is-invalid' : ''); ?>" id="exampleInputEmail1" placeholder="Password Konfirmasi" autofocus>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('password_konfirmasi'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>


    </div>
</div>
<?= $this->endSection(); ?>