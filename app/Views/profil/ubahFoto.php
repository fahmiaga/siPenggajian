<?php

use Config\Validation;
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header mb-2">Form Ubah Data Karyawan</h1>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <?= session()->getFlashdata('pesan'); ?>
    <?php endif; ?>
    <form method="POST" action="/profil/updateFoto/<?= $karyawan['id_karyawan']; ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="id_karyawan" value="<?= $karyawan['id_karyawan']; ?>">
        <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-2">
                <img src="/img/<?= $karyawan['foto']; ?>" class="img-thumbnail img-preview" alt="">
            </div>
            <div class="col-sm-5">
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" autofocus onchange="previewImg()">
                    <label class="custom-file-label" for="foto">
                        <p id="p"><?= $karyawan['foto']; ?></p>
                    </label>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('foto'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>