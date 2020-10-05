<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12  main">
    <h1 class="page-header">Detail Gaji Karyawan</h1>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Gaji Pokok</th>
                    <th scope="col">T. Pekerjaan</th>
                    <th scope="col">T. Anak</th>
                    <th scope="col">Lembur</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($gaji as $gj) :
                    $hasil = 0;
                    $total = $gj['gaji'] + $gj['tjg_pekerjaan'] + $gj['tjg_anak'] + intVal($gj['lembur']);
                ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $gj['nama_karyawan'] ?></td>
                        <td><?= $gj['pekerjaan'] ?></td>
                        <td>Rp. <?= number_format($gj['gaji'], 2, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($gj['tjg_pekerjaan'], 2, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($gj['tjg_anak'], 2, ',', '.'); ?></td>
                        <td><?= number_format(intVal($gj['lembur']), 2, ',', '.') ?></td>
                        <td>Rp. <?= number_format($total, 2, ',', '.'); ?></td>
                    </tr>
                    <?php $hasil += $total; ?>
                <?php endforeach; ?>
            </tbody>
            <tr>
                <th colspan="7">Total Keseluruhan</th>
                <th>Rp. <?= number_format($hasil, 2, ',', '.'); ?></th>
            </tr>
        </table>
        <a href="/user" class="btn btn-primary">Kembali</a>

    </div>
</div>
<?= $this->endSection(); ?>