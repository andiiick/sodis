<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FormIN extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title'       => 'Form Entri Surat Masuk',
            'isi'         => 'formIN/v_formIN',
            'klasifikasi' => $this->klas->get_klas(),
            'sifat'       => $this->sfat->get_sifat(),
        ];
        return view('layout/v_wrapper', $data);
    }
}
