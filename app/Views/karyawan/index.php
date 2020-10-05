<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header">Data Karyawan</h1>
    <div class="row">
        <div class="col">

            <a href="/karyawan/create" class="btn btn-primary mb-2">Tambah Data Karyawan</a>
        </div>
        <div class="col-sm-5 mr-5">
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan Keyword....." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 + (5 * ($currentPage - 1));
                foreach ($karyawan as $kry) : ?>
                    <tr>
                        <th scope="row"><?= ++$i; ?></th>
                        <td><?= $kry['nama_karyawan']; ?></td>
                        <td><?= $kry['nik']; ?></td>
                        <td><?= $kry['pekerjaan']; ?></td>
                        <td>
                            <a href="/karyawan/detail/<?= $kry['id_karyawan']; ?>" class="text-info"><i class="far fa-eye"></i></a>
                            <a href="/karyawan/edit/<?= $kry['id_karyawan']; ?>" class="text-warning"><i class="far fa-edit"></i></a>
                            <a href="/karyawan/delete/<?= $kry['id_karyawan']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="text-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('karyawan', 'karyawan_pagination'); ?>
    </div>
</div>
<?= $this->endSection(); ?>