<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'id_pekerjaan', 'tgl_gaji', 'tjg_pekerjaan', 'tjg_anak', 'lembur', 'id_tanggal'];

    public function getGaji()
    {
        return $this->findAll();
    }
    public function getGajiById($id)
    {
        return $this->db->table('gaji')
            ->join('pekerjaan', 'pekerjaan.id_pekerjaan = gaji.id_pekerjaan')
            ->join('karyawan', 'karyawan.id_karyawan = gaji.id_karyawan')->where('id_tanggal', $id)->get()->getResultArray();
    }
    public function getGajiKaryawanById($id, $id_karyawan)
    {
        return $this->db->table('gaji')
            ->join('pekerjaan', 'pekerjaan.id_pekerjaan = gaji.id_pekerjaan')
            ->join('karyawan', 'karyawan.id_karyawan = gaji.id_karyawan')->where('id_tanggal', $id)
            ->where('karyawan.id_karyawan', $id_karyawan)->get()->getResultArray();
    }
    public function deleteGaji($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('gaji');
        $builder->where('id_tanggal', $id);
        $builder->delete();
    }
}
