<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title><?= $judul; ?></title>
</head>

<body>
    <h2 style="text-align: center;">Laporan Gaji Karyawan</h2>
    <h4 style="text-align: center;">Tanggal <?= $tanggal['tanggal']; ?></h4>

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
                $total = $gj['gaji'] + $gj['tjg_pekerjaan'] + $gj['tjg_anak'];
            ?>
                <tr>
                    <td><?= ++$i; ?></td>
                    <td><?= $gj['nama_karyawan'] ?></td>
                    <td><?= $gj['pekerjaan'] ?></td>
                    <td>Rp. <?= number_format($gj['gaji'], 2, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($gj['tjg_pekerjaan'], 2, ',', '.'); ?></td>
                    <td>Rp. <?= number_format($gj['tjg_anak'], 2, ',', '.'); ?></td>
                    <td><?= $gj['lembur'] ?></td>
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
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>