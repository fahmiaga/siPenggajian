<?php

namespace App\Controllers;


use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;
use App\Models\LemburModel;

class Profil extends BaseController
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
        $data = [
            'judul' => 'Ubah Password',
            'validation' => \Config\Services::validation(),
        ];
        return view('profil/index', $data);
    }
    public function update($id)
    {
        $password =  $this->request->getVar('password');
        $passwordLama = session()->get('password');
        // dd($passwordLama);
        if ($password != $passwordLama) {

            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       Password Lama Salah.
       </div>');
            return redirect()->to('/profil/index/' . $id)->withInput();
        }
        if (!$this->validate([
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password lama harus diisi',
                ]
            ],
            'password_baru' => [
                'rules' => 'required|matches[password_konfirmasi]',
                'errors' => [
                    'required' => 'password baru harus diisi',
                    'matches'  => 'password baru tidak sama dengan password konfirmasi'
                ]
            ],
            'password_konfirmasi' => [
                'rules' => 'required|matches[password_baru]',
                'errors' => [
                    'required' => 'password konfirmasi harus diisi',
                    'matches'  => 'password konfirmasi tidak sama dengan password baru'
                ]
            ],
        ])) {

            return redirect()->to('/profil/index/' . $id)->withInput();
        }

        $this->karyawanModel->save([
            'id_karyawan' => $id,
            'password'  => $this->request->getVar('password_baru')
        ]);

        session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Password Berhasil Diubah.
       </div>');
        return redirect()->to('/profil/index/' . $id)->withInput();
    }
    public function ubahFoto()
    {
        $id = session()->get('id_karyawan');
        $data = [
            'judul'      => 'Form Ubah Foto',
            'karyawan'   => $this->karyawanModel->getKaryawanById($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('profil/ubahFoto', $data);
    }
    public function updateFoto($id)
    {
        if (!$this->validate([
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('/profil/ubahFoto/' . $id)->withInput();
        }
        $fileFoto = $this->request->getFile('foto');

        //cek foto
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            //ambil nama file
            $namaFoto = $fileFoto->getName();
            //pindahkan file
            $fileFoto->move('img');
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $this->karyawanModel->save([
            'id_karyawan' => $id,
            'foto'        => $namaFoto
        ]);
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Foto Berhasil Diubah.
       </div>');
        return redirect()->to('/profil/ubahFoto/' . $id)->withInput();
    }
}
