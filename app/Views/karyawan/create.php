<?php

use Config\Validation;
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header mb-2">Form Tambah Karyawan</h1>
    <form method="POST" action="/karyawan/save" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-2">
                <img src="/img/default.png" class="img-thumbnail img-preview" alt="">
            </div>

            <div class="col-sm-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input <?= ($validation->hasError('foto') ? 'is-invalid' : ''); ?>" id="foto" name="foto" autofocus onchange="previewImg()">
                    <label class="custom-file-label" for="foto">
                        <p id="p">Pilih Foto</p>
                    </label>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        <?= $validation->getError('foto'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-5">
                <input type="text" class="form-control <?= ($validation->hasError('nama_karyawan') ? 'is-invalid' : ''); ?>" name="nama_karyawan" id="inputPassword3" value="<?= old('nama_karyawan'); ?>">
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama_karyawan'); ?>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-5">
                <input type="date" class="form-control <?= ($validation->hasError('tgl_lahir') ? 'is-invalid' : ''); ?>" name="tgl_lahir" id="inputPassword3" value="<?= old('tgl_lahir'); ?>">
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('tgl_lahir'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-5">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="laki" name="gender" class="custom-control-input" value="Laki-laki" required>
                    <label class="custom-control-label" for="laki">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="perempuan" name="gender" class="custom-control-input" value="Perempuan" required>
                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                    <div class="invalid-feedback"><?= $validation->hasError('gender'); ?></div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : ''); ?>" name="alamat" id="inputPassword3" value="<?= old('alamat'); ?>"></textarea>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('alamat'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="col-sm-5">
                <select class="custom-select" name="pekerjaan" required>
                    <option selected>Silahkan pilih</option>
                    <?php foreach ($pekerjaan as $kerja) : ?>
                        <option value="<?= $kerja['nama_pekerjaan']; ?>"><?= $kerja['nama_pekerjaan'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('pekerjaan'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-5">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="status_kawin" class="custom-control-input" value="Kawin" required>
                    <label class="custom-control-label" for="customRadioInline1">Kawin</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="status_kawin" class="custom-control-input" value="Tidak Kawin" required>
                    <label class="custom-control-label" for="customRadioInline2">Tidak Kawin</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah Anak</label>
            <div class="col-sm-5">
                <input type="number" class="form-control  <?= ($validation->hasError('jml_anak') ? 'is-invalid' : ''); ?>" name="jml_anak" id="inputPassword3" value="<?= old('jml_anak'); ?>">
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('jml_anak'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Tahun Masuk</label>
            <div class="col-sm-5">
                <input type="number" class="form-control  <?= ($validation->hasError('thn_masuk') ? 'is-invalid' : ''); ?>" name="thn_masuk" id="inputPassword3" value="<?= old('thn_masuk'); ?>">
                <div id="validationServer05Feedback" class="invalid-feedback">
                    <?= $validation->getError('thn_masuk'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>