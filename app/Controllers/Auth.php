<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use App\Models\GajiModel;
use App\Models\TanggalModel;
use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Database\Query;

class Auth extends BaseController
{
    protected $karyawanModel;
    public function __construct()
    {
        $this->gajiModel = new GajiModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->karyawanModel = new KaryawanModel();
        $this->tanggalModel = new TanggalModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/index', $data);
    }
    public function login()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/auth/index')->withInput();
        }

        $db      = \Config\Database::connect();
        // $session = session();
        $builder = $db->table('karyawan');

        $nik = $this->request->getVar('nik');
        $password = $this->request->getVar('password');
        $karyawan = $builder->getWhere(['nik' => $nik])->getRowArray();

        if ($karyawan) {
            if ($password == $karyawan['password']) {
                $data = [
                    'id_karyawan' => $karyawan['id_karyawan'],
                    'password' => $karyawan['password'],
                    'nama_karyawan' => $karyawan['nama_karyawan'],
                    'pekerjaan' => $karyawan['pekerjaan'],
                    'foto' => $karyawan['foto'],
                    'login' => true,
                ];
                session()->set($data);

                if ($karyawan['pekerjaan'] == 'Admin') {
                    return redirect()->to('/karyawan');
                } else if ($karyawan['pekerjaan'] == 'Manager') {
                    return redirect()->to('/manager/index');
                } else {
                    return redirect()->to('/user');
                }
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password salah.
               </div>');
                return redirect()->to('/auth/index');
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Karyawan tidak ditemukan.
           </div>');
            return redirect()->to('/auth/index');
        }
    }
    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Anda Telah Keluar.
       </div>');
        return redirect()->to('/auth');
    }
    //--------------------------------------------------------------------

}
