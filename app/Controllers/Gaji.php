<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;
use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Database\Query;

class Gaji extends BaseController
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

        $currentPage = $this->request->getVar('page_gaji') ? $this->request->getVar('page_gaji') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $tanggal = $this->tanggalModel->cari($keyword);
        } else {
            $tanggal = $this->tanggalModel;
        }

        $data = [
            'judul'   => 'Data Tanggal',
            'tanggal' => $tanggal->paginate(5, 'tanggal'),
            'pager' => $this->tanggalModel->pager,
            'currentPage' => $currentPage
        ];

        return view('gaji/index', $data);
    }
    public function create()
    {
        $data = [
            'judul'   => 'Form Data Gaji Karyawan',
            'validation' => \Config\Services::validation()
        ];

        return view('gaji/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required|is_unique[tanggal]',
                'errors' => [
                    'required' => 'tanggal gaji harus diisi',
                    'is_unique' => 'tanggal gaji telah ada di database'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/gaji/create')->withInput()->with('validation', $validation);
        }

        $this->tanggalModel->save([
            'tanggal' => $this->request->getVar('tanggal')
        ]);

        $db = \Config\Database::connect();

        $query = $db->query('SELECT MAX(id_tanggal) FROM tanggal');
        $id_tanggal = $query->getRowArray();



        $karyawan = $this->karyawanModel->getKaryawan();
        foreach ($karyawan as $kry) {
            //tjg_pekerjaan
            $tjg_pekerjaan = 0;
            if ($kry['pekerjaan'] == 'Manager') {
                $tjg_pekerjaan = 1000000;
            } else if ($kry['pekerjaan'] == 'Programmer') {
                $tjg_pekerjaan = 700000;
            } else {
                $tjg_pekerjaan = 500000;
            }

            //tjg_anak
            $tjg_anak = 0;
            if ($kry['jml_anak'] == 0) {
                $tjg_anak = 0;
            } else if ($kry['jml_anak'] == 1) {
                $tjg_anak = 150000;
            } else if ($kry['jml_anak'] == 2) {
                $tjg_anak = 250000;
            } else if ($kry['jml_anak'] == 3) {
                $tjg_anak = 400000;
            } else {
                $tjg_anak = 500000;
            }
            $this->gajiModel->save([
                'id_tanggal'  => implode($id_tanggal),
                'id_karyawan' => $kry['id_karyawan'],
                'id_pekerjaan' => $kry['id_pekerjaan'],
                'tjg_pekerjaan' => $tjg_pekerjaan,
                'tjg_anak' => $tjg_anak,
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/gaji');
    }
    public function detail($id)
    {
        $data = [
            'judul'   => 'Detail Gaji Karyawan',
            'gaji'    => $this->gajiModel->getGajiById($id)
        ];

        return view('gaji/detail', $data);
    }
    public function edit($id)
    {
        $data = [
            'judul'   => 'Form Data Gaji Karyawan',
            'validation' => \Config\Services::validation(),
            'tanggal' => $this->tanggalModel->getTanggalById($id)
        ];

        return view('gaji/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required|is_unique[tanggal]',
                'errors' => [
                    'required' => 'tanggal gaji harus diisi',
                    'is_unique' => 'tanggal sudah ada di database'
                ]
            ],
        ])) {

            return redirect()->to('/gaji/edit/' . $id)->withInput();
        }
        $this->tanggalModel->save([
            'id_tanggal' => $id,
            'tanggal' => $this->request->getVar('tanggal')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/gaji');
    }
    public function delete($id)
    {
        $gaji = $this->gajiModel->getGaji();
        $this->tanggalModel->delete($id);

        $this->gajiModel->deleteGaji($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/gaji');
    }
}
