<?php

namespace App\Controllers;


use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;

class Manager extends BaseController
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
            'judul' => 'Laporan Gaji',
            'request' => \Config\Services::request(),
            'tanggal' => $tanggal->paginate(5, 'tanggal'),
            'pager'   => $this->tanggalModel->pager,
            'currentPage' => $curretPage
        ];

        return view('manager/index', $data);
    }
    public function detailGaji($id)
    {
        $data = [
            'judul'   => 'Detail Gaji Karyawan',
            'gaji'    => $this->gajiModel->getGajiById($id)
        ];

        return view('manager/detailGaji', $data);
    }
    public function printLaporan($id)
    {
        $data = [
            'judul' => 'Laporan Gaji Karyawan',
            'gaji' => $this->gajiModel->getGajiById($id),
            'tanggal' => $this->tanggalModel->getTanggalById($id)
        ];

        return view('manager/printLaporan', $data);
    }
    //--------------------------------------------------------------------

}
