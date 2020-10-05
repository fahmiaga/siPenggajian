<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header">Data Pekerjaan</h1>
    <a href="/pekerjaan/create" class="btn btn-primary mb-2">Tambah Data Pekerjaan</a>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pekerjaan</th>
                    <th scope="col">Gaji</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($pekerjaan as $kerja) : ?>
                    <tr>
                        <th scope="row"><?= ++$i; ?></th>
                        <td><?= $kerja['nama_pekerjaan']; ?></td>
                        <td><?= $kerja['gaji']; ?></td>
                        <td>
                            <a href="/pekerjaan/edit/<?= $kerja['id_pekerjaan']; ?>" class="text-warning"><i class="far fa-edit"></i></a>
                            <form action="/pekerjaan/delete/<?= $kerja['id_pekerjaan']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="text-danger" onclick="return confirm('Apakah Anda Yakin ?');"><i class="far fa-trash-alt"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>