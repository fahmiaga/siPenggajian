<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;

class Pekerjaan extends BaseController
{
    protected $pekerjaanModel;
    public function __construct()
    {
        $this->pekerjaanModel = new PekerjaanModel();
    }
    public function index()
    {
        $data = [
            'judul'    => 'Data Pekerjaan',
            'pekerjaan' => $this->pekerjaanModel->getPekerjaan(),
        ];
        return view('pekerjaan/index', $data);
    }
    public function create()
    {
        $data = [
            'judul'  => 'Tambah Data Pekerjaan',
            'validation' => \Config\Services::validation()

        ];
        return view('pekerjaan/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama_pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama pekerjaan harus diisi'
                ]
            ],
            'gaji' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pekerjaan/create')->withInput()->with('validation', $validation);
        }
        $this->pekerjaanModel->save([
            'nama_pekerjaan' => $this->request->getVar('nama_pekerjaan'),
            'gaji' => $this->request->getVar('gaji')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil DItambahkan');
        return redirect()->to('/pekerjaan');
    }
    public function delete($id)
    {
        $this->pekerjaanModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/Pekerjaan');
    }
    public function edit($id)
    {
        $data = [
            'judul'  => '= Ubah Data Pekerjaan',
            'validation' => \Config\Services::validation(),
            'pekerjaan' => $this->pekerjaanModel->getPekerjaanById($id)

        ];
        return view('pekerjaan/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama_pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama pekerjaan harus diisi'
                ]
            ],
            'gaji' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pekerjaan/edit/' . $id)->withInput()->with('validation', $validation);
        }
        $this->pekerjaanModel->save([
            'id_pekerjaan' => $id,
            'nama_pekerjaan' => $this->request->getVar('nama_pekerjaan'),
            'gaji' => $this->request->getVar('gaji')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/pekerjaan');
    }
    //--------------------------------------------------------------------

}
