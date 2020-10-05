<?php

namespace App\Controllers;


use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;
use App\Models\LemburModel;

class Lembur extends BaseController
{
    protected $gajiModel;
    public function __construct()
    {
        $this->gajiModel = new GajiModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->karyawanModel = new KaryawanModel();
        $this->tanggalModel = new TanggalModel();
        $this->lemburModel = new LemburModel();
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

        return view('lembur/index', $data);
    }
    public function create($id)
    {
        $data = [
            'judul' => 'Tambah Data Lembur',
            'validation' => \Config\Services::validation(),
            'id' => $id
        ];

        return view('lembur/create', $data);
    }
    public function save($id)
    {
        if (!$this->validate([
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi lembur harus diisi',
                ]
            ],
            'lama_lembur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'lama lembur harus diisi',
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/lembur/create/' . $id)->withInput()->with('validation', $validation);
        }

        $deskripsi = $this->request->getVar('deskripsi');
        $lama_lembur = $this->request->getVar('lama_lembur');
        $id_karyawan = session()->get('id_karyawan');

        $this->lemburModel->save([
            'deskripsi' => $deskripsi,
            'lama_lembur' => $lama_lembur,
            'id_tanggal' => $id,
            'id_karyawan' => $id_karyawan,
            'status' => '<i class="far fa-pause-circle text-warning"></i>',
            'total' => '-'
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/lembur');
    }
    public function detail($id)
    {
        $id_karyawan = session()->get('id_karyawan');
        $data = [
            'judul'   => 'Detail Lembur Karyawan',
            'lembur'    => $this->lemburModel->getLemburKaryawanById($id, $id_karyawan)
        ];

        return view('lembur/detail', $data);
    }
    public function lemburKaryawan()
    {
        $data = [
            'judul'  => 'Lembur Karyawan',
            'lembur' => $this->lemburModel->findAll()

        ];
        return view('lembur/lemburKaryawan', $data);
    }
    public function edit($id)
    {
        $data = [
            'judul' => 'Form Edit Lembur',
            'lembur' => $this->lemburModel->getLemburById($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('/lembur/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi gaji harus diisi',
                ]
            ],
            'lama_lembur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'lama_lembur gaji harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/lembur/edit/' . $id)->withInput();
        }
        $id_tanggal = $this->request->getVar('id_tanggal');
        $this->lemburModel->save([
            'id_lembur' => $id,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'lama_lembur' => $this->request->getVar('lama_lembur')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/lembur/detail/' . $id_tanggal)->withInput();
    }
    public function delete($id)
    {
        $this->lemburModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/lembur/detail/' . $id)->withInput();
    }
    public function approve($id, $id_tanggal, $id_karyawan)
    {
        $lembur = $this->lemburModel->where('id_lembur', $id)->first();
        $jamLembur = $lembur['lama_lembur'];
        $this->lemburModel->approve($id, $jamLembur, $id_tanggal, $id_karyawan);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate');
        return redirect()->to('/lembur/lemburKaryawan');
    }
    public function reject($id, $id_tanggal, $id_karyawan)
    {
        $lembur = $this->lemburModel->where('id_lembur', $id)->first();
        $jamLembur = $lembur['lama_lembur'];
        $this->lemburModel->reject($id, $jamLembur, $id_tanggal, $id_karyawan);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate');
        return redirect()->to('/lembur/lemburKaryawan');
    }
    //--------------------------------------------------------------------

}
