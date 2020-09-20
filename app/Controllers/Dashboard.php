<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Dashboard',
            'isi' => 'v_dashboard',
            'scriptJS' => false,
        ];
        echo view('layout/v_wrapper', $data);
    }
    //--------------------------------------------------------------------

}
