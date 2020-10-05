<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PekerjaanModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Database\Query;

class Karyawan extends BaseController
{
    // public function before(RequestInterface $request, $arguments = null)
    // {
    //     if (!session()->has('nik')) {
    //         return redirect()->to('/auth');
    //     }
    // }
    protected $karyawanModel;
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->pekerjaanModel = new PekerjaanModel();

        if (!session()->has('nik')) {
            return redirect()->to('/auth');
        }
    }
    public function index()
    {


        $currentPage = $this->request->getVar('page_karyawan') ? $this->request->getVar('page_karyawan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $karyawan = $this->karyawanModel->search($keyword);
        } else {
            $karyawan = $this->karyawanModel;
        }

        $data = [
            'judul'   => 'Data Karyawan',
            'karyawan' => $karyawan->paginate(5, 'karyawan'),
            'pager' => $this->karyawanModel->pager,
            'currentPage' => $currentPage
        ];

        return view('karyawan/index', $data);
    }
    public function create()
    {
        $data = [
            'judul' => 'Form Tambah Data Karyawan',
            'validation' => \Config\Services::validation(),
            'pekerjaan' => $this->pekerjaanModel->getPekerjaan()
        ];
        return view('karyawan/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama_karyawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama karyawan harus diisi'
                ]
            ],

            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir harus diisi'
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'thn_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tahun masuk harus diisi'
                ]
            ],
            'jml_anak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah anak harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/karyawan/create')->withInput()->with('validation', $validation);
            return redirect()->to('/karyawan/create')->withInput();
        }
        $fileFoto = $this->request->getFile('foto');;

        //cek foto
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            //ambil nama file
            $namaFoto = $fileFoto->getName();
            //pindahkan file
            $fileFoto->move('img');
        }


        //membuat nik karyawan
        $db = \Config\Database::connect();

        $query = $db->query('SELECT MAX(id_karyawan) FROM karyawan');
        $a = $query->getRowArray();

        $kodemax = str_pad(implode($a), 4, "0", STR_PAD_LEFT);

        $kGender = 0;
        if ($this->request->getVar('gender') == 'Laki-laki') {
            $kGender = '11';
        } else {
            $kGender = '10';
        }

        $kTgl_lahir = substr($this->request->getVar('tgl_lahir'), -8, 2);
        $kTahun_masuk = substr($this->request->getVar('thn_masuk'), -2);

        $nik = $kGender . $kTgl_lahir  . $kTahun_masuk . $kodemax++;

        //ambil id_pekerjaan

        $pekerjaan = $this->request->getVar('pekerjaan');
        $id = $this->pekerjaanModel->getId($pekerjaan);


        $this->karyawanModel->save([
            'foto' => $namaFoto,
            'id_pekerjaan' => $id['id_pekerjaan'],
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),
            'nik' => $nik,
            'password' => $nik,
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'gender' => $this->request->getVar('gender'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'status_kawin' => $this->request->getVar('status_kawin'),
            'jml_anak' => $this->request->getVar('jml_anak'),
            'thn_masuk' => $this->request->getVar('thn_masuk'),
        ]);


        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/karyawan');
    }
    public function detail($id)
    {
        $data = [
            'judul'   => 'Detail Karyawan',
            'karyawan' => $this->karyawanModel->getKaryawanById($id)
        ];

        return view('karyawan/detail', $data);
    }
    public function edit($id)
    {
        $data = [
            'judul' => 'Form Ubah Data Karyawan',
            'validation' => \Config\Services::validation(),
            'karyawan' => $this->karyawanModel->getKaryawanById($id),
            'pekerjaan' => $this->pekerjaanModel->getPekerjaan()
        ];
        return view('karyawan/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama_karyawan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama karyawan harus diisi'
                ]
            ],

            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir harus diisi'
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'thn_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tahun masuk harus diisi'
                ]
            ],
            'jml_anak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah anak harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/karyawan/create' . $id)->withInput();
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


        //membuat nik karyawan
        $db = \Config\Database::connect();

        $query = $db->query('SELECT MAX(id_karyawan) FROM karyawan');
        $a = $query->getRowArray();

        $kodemax = str_pad(implode($a), 4, "0", STR_PAD_LEFT);

        $kGender = 0;
        if ($this->request->getVar('gender') == 'Laki-laki') {
            $kGender = '11';
        } else {
            $kGender = '10';
        }

        $kTgl_lahir = substr($this->request->getVar('tgl_lahir'), -8, 2);
        $kTahun_masuk = substr($this->request->getVar('thn_masuk'), -2);

        $nik = $kGender . $kTgl_lahir  . $kTahun_masuk . $kodemax++;

        //
        $this->karyawanModel->save([
            'id_karyawan' => $id,
            'foto' => $namaFoto,
            'nama_karyawan' => $this->request->getVar('nama_karyawan'),

            'nik' => $nik,
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'gender' => $this->request->getVar('gender'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'status_kawin' => $this->request->getVar('status_kawin'),
            'jml_anak' => $this->request->getVar('jml_anak'),
            'thn_masuk' => $this->request->getVar('thn_masuk'),
        ]);


        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('/karyawan');
    }
    public function delete($id)
    {
        //cari gambar berdasarkan id
        $foto = $this->karyawanModel->find($id);
        if ($foto['foto'] != 'default.png') {
            //hapus foto
            unlink('img/' . $foto['foto']);
        }
        $this->karyawanModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/karyawan');
    }
    //--------------------------------------------------------------------

}
