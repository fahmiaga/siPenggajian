<?php

namespace App\Models;

use CodeIgniter\Model;

class LemburModel extends Model
{
    protected $table = 'lembur';
    protected $primaryKey = 'id_lembur';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_karyawan', 'id_tanggal', 'deskripsi', 'lama_lembur', 'status', 'total'];

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
    public function getLemburKaryawanById($id, $id_karyawan)
    {
        return $this->where('id_tanggal', $id)->where('id_karyawan', $id_karyawan)->get()->getResultArray();
    }
    public function getLemburById($id)
    {
        return $this->where('id_lembur', $id)->first();
    }
    public function deleteGaji($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('gaji');
        $builder->where('id_tanggal', $id);
        $builder->delete();
    }
    public function approve($id, $jamLembur, $id_tanggal, $id_karyawan)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('lembur');
        $builder->set('status', '<i class="fas fa-check text-success"></i>');
        $builder->set('total', $jamLembur * 25000);
        $builder->where('id_lembur', $id);
        $builder->update();

        $db = \Config\Database::connect();
        $builder2 = $db->table('gaji');
        $builder2->set('lembur', $jamLembur * 25000);
        $builder2->where('id_tanggal', $id_tanggal);
        $builder2->where('id_karyawan', $id_karyawan);
        $builder2->update();
    }
    public function reject($id, $jamLembur, $id_tanggal, $id_karyawan)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('lembur');
        $builder->set('status', '<i class="fas fa-times text-danger"></i>');
        $builder->set('total', 0);
        $builder->where('id_lembur', $id);
        $builder->update();

        $db = \Config\Database::connect();
        $builder2 = $db->table('gaji');
        $builder2->set('lembur', 0);
        $builder2->where('id_tanggal', $id_tanggal);
        $builder2->where('id_karyawan', $id_karyawan);
        $builder2->update();
    }
}
