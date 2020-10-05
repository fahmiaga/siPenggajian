<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // $data = [
        //     'judul' => 'Dashboard',
        //     'request' => \Config\Services::request()
        // ];

        // return view('dashboard/index', $data);
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda Bukan Manager');
    }

    //--------------------------------------------------------------------

}
