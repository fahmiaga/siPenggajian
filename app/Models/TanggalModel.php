<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggalModel extends Model
{
    protected $table = 'tanggal';
    protected $primaryKey = 'id_tanggal';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal'];

    public function getTanggal()
    {
        return $this->findAll();
    }
    public function getTanggalById($id)
    {
        return $this->where('id_tanggal', $id)->first();
    }
    public function cari($keyword)
    {
        return $this->table('tanggal')->like('tanggal', $keyword);
    }
}
