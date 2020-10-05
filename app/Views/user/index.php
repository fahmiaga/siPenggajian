<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header">Laporan Gaji Karyawan</h1>
    <div class="col-sm-4">
        <form action="" method="POST">
            <div class="input-group mb-3">
                <input type="date" class="form-control" placeholder="Masukkan Keyword....." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" autocomplete="off" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 + (5 * ($currentPage - 1));
                foreach ($tanggal as $tgl) : ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $tgl['tanggal']; ?></td>
                        <td>
                            <a href="/user/detailGaji/<?= $tgl['id_tanggal']; ?>" class="text-info"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('tanggal', 'karyawan_pagination'); ?>
    </div>
</div>
<?= $this->endSection(); ?>