<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Login Area'];
        echo view('v_login', $data);
    }

    public function cek_login()
    {
        if ($this->request->isAJAX()) {
            $nip      = $this->request->getPost('nip');
            $password = sha1(md5($this->request->getPost('password')));

            $cek = $this->logs->loginCheck($nip, $password);
            if ($cek['status_cd'] == 'deactive') {
                $msg = ['gagal' => "Login Gagal.. Akun Anda tidak aktif"];
            } else if ($cek['nip'] != $nip) {
                $msg = ['gagal' => "Login Gagal.. NIP/NIK tidak ditemukan"];
            } else {
                session()->set('idUser', $cek['idUser']);
                session()->set('nama', $cek['nama']);
                session()->set('nip', $cek['nip']);
                session()->set('nmJabatan', $cek['nmJabatan']);
                session()->set('akses', $cek['akses']);
                session()->set('jenisKelamin', $cek['jenisKelamin']);
                $msg = ['sukses' => 'Selamat Datang.. ' . session()->get('nama') . '',];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function logout()
    {
        session()->setTempdata('idUser');
        session()->setTempdata('nama');
        session()->setTempdata('nip');
        session()->setTempdata('akses');
        session()->setTempdata('jenisKelamin');
        session()->setFlashdata('sukses', 'Anda telah logout ..');
        return redirect()->to(base_url('/'));
    }
    //--------------------------------------------------------------------

}
