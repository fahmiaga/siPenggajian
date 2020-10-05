<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12  main">
    <h1 class="page-header">Detail Lembur Karyawan</h1>
    <div class="row">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Lama Lembur /jam</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Lembur</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($lembur as $lbr) : ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $lbr['deskripsi'] ?></td>
                        <td><?= $lbr['lama_lembur'] ?> jam</td>
                        <td><?= $lbr['status'] ?> </td>
                        <td>Rp.
                            <?php if ($lbr['total'] == '-') : ?>
                                <?= '-'; ?>
                            <?php else : ?>
                                <?= number_format($lbr['total'], 2, ',', '.'); ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <?php if ($lbr['status'] == '<i class="fas fa-check text-success"></i>' || $lbr['status'] == '<i class="fas fa-times text-danger"></i>') : ?>
                            <?= '<i class="fas fa-check text-success"></i>'; ?>
                        <?php else : ?>
                            <a href="/lembur/edit/<?= $lbr['id_lembur']; ?>" class="text-warning"><i class="fas fa-edit"></i></a>
                            <a href="/lembur/delete/<?= $lbr['id_lembur']; ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                        <?php endif; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/lembur" class="btn btn-primary">Kembali</a>
    </div>
</div>
<?= $this->endSection(); ?>