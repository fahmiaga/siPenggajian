<?php

namespace App\Controllers;


use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;

class User extends BaseController
{
    protected $gajiModel;
    public function __construct()
    {
        $this->gajiModel = new GajiModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->karyawanModel = new KaryawanModel();
        $this->tanggalModel = new TanggalModel();
    }

    public function index()
    {

        $curretPage = $this->request->getVar('page_tanggal') ? $this->request->getVar('page_tanggal') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $tanggal = $this->tanggalModel->cari($keyword);
        } else {
            $tanggal = $this->tanggalModel;
        }

        $data = [
            'judul' => 'Data Gaji Gaji',
            'request' => \Config\Services::request(),
            'tanggal' => $tanggal->paginate(5, 'tanggal'),
            'pager'   => $this->tanggalModel->pager,
            'currentPage' => $curretPage
        ];

        return view('user/index', $data);
    }
    public function detailGaji($id)
    {
        $id_karyawan = session()->get('id_karyawan');
        $data = [
            'judul'   => 'Detail Gaji Karyawan',
            'gaji'    => $this->gajiModel->getGajiKaryawanById($id, $id_karyawan)
        ];

        return view('user/detailGaji', $data);
    }
    //--------------------------------------------------------------------

}
