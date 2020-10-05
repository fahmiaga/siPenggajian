<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table = 'pekerjaan';
    protected $primaryKey = 'id_pekerjaan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pekerjaan', 'gaji'];

    public function getPekerjaan()
    {
        return $this->findAll();
    }
    public function getPekerjaanById($id)
    {
        return $this->where('id_pekerjaan', $id)->first();
    }
    public function getId($pekerjaan)
    {
        return $this->where('nama_pekerjaan', $pekerjaan)->first();
    }
}
