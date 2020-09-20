<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SuratMasuk extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Surat Masuk',
            'isi'   => 'suratMasuk/v_suratMasuk',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildataSemua()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'surat'  => $this->srt->get_suratmasuk(),
            ];
            $msg = [
                'data' => view('suratMasuk/v_tableSemua', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $idUser = $this->request->getPost('idUser');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->user->update($idUser, $data);
            $msg = [
                'sukses' => 'Data pengguna telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $idUser    = $this->request->getPost('idUser');
            $nmJabatan = $this->request->getPost('nmJabatan');
            $res       = $this->user->find($idUser);
            $data = [
                'idUser'       => $idUser,
                'nip'          => $res['nip'],
                'nmJabatan'    => $nmJabatan,
                'nama'         => $res['nama'],
                'telepon'      => $res['telepon'],
                'email'        => $res['email'],
                'alamat'       => $res['alamat'],
                'jenisKelamin' => $res['jenisKelamin'],
                'akses'        => $res['akses'],
                'foto'         => $res['foto'],
                'status_cd'    => $res['status_cd'],
            ];
            $msg = [
                'sukses' => view('user/v_modaldetail', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
