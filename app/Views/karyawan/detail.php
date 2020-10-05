<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-sm-12 main">
    <h1 class="page-header">Detail Karyawan</h1>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="/img/<?= $karyawan['foto']; ?>" class="rounded float-left" alt="..." width="180" height="200">
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>Nama </td>
                        <td><?= $karyawan['nama_karyawan']; ?></td>
                    </tr>
                    <tr>
                        <td>NIK </td>
                        <td><?= $karyawan['nik']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir </td>
                        <td><?= $karyawan['tgl_lahir']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin </td>
                        <td><?= $karyawan['gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan </td>
                        <td><?= $karyawan['pekerjaan']; ?></td>
                    </tr>
                    <tr>
                        <td>Status </td>
                        <td><?= $karyawan['status_kawin']; ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Anak </td>
                        <td><?= $karyawan['jml_anak']; ?></td>
                    </tr>
                    <tr>
                        <td>Tahun Masuk </td>
                        <td><?= $karyawan['thn_masuk']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td><?= $karyawan['alamat']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>