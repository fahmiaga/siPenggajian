<?php

namespace App\Models;

use CodeIgniter\Model;


class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_karyawan', 'nik', 'tgl_lahir', 'gender', 'alamat', 'pekerjaan', 'status_kawin', 'jml_anak', 'foto', 'thn_masuk', 'password', 'id_pekerjaan'];

    public function getKaryawan()
    {
        return $this->findAll();
    }
    public function getKaryawanById($id)
    {
        return $this->where('id_karyawan', $id)->first();
    }
    public function search($keyword)
    {
        // $builder = $this->table('karyawan');
        // $builder->like('nama', $keyword);
        // return $builder;
        return $this->table('karyawan')->like('nama_karyawan', $keyword)->orLike('nik', $keyword)->orLike('pekerjaan', $keyword);
    }
}
