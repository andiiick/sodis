<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Sifat extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Data Sifat Surat',
            'isi'   => 'sifat/v_sifat',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'sifat' => $this->sfat->get_sifat(),
            ];
            $msg = [
                'data' => view('sifat/v_table', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('sifat/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nmSifat = $this->request->getPost('nmSifat');
            $valid = $this->validate([
                'nmSifat' => [
                    'label' => 'Nama sifat surat <b>' . $nmSifat . '</b>',
                    'rules' => 'required|is_unique[sifat.nmSifat]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nmSifat' => $this->validation->getError('nmSifat'),
                    ]
                ];
            } else {
                $data = [
                    'nmSifat'      => ucwords($nmSifat),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->sfat->insert($data);
                $msg = [
                    'sukses' => 'Data sifat surat berhasil ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $idSifat = $this->request->getPost('idSifat');
            $res = $this->sfat->find($idSifat);
            $data = [
                'idSifat' => $res['idSifat'],
                'nmSifat' => $res['nmSifat'],
            ];
            $msg = [
                'sukses' => view('sifat/v_modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idSifat = $this->request->getPost('idSifat');
            $nmSifat = $this->request->getPost('nmSifat');

            // $cek = $this->sfat->sifatCheck($idSifat);

            $valid = $this->validate([
                'nmSifat' => [
                    'label' => 'Nama sifat surat <b>' . $nmSifat . '</b>',
                    'rules' => 'required|is_unique[sifat.nmSifat]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nmSifat' => $this->validation->getError('nmSifat'),
                    ]
                ];
            } else {
                $data = [
                    'nmSifat'      => ucwords($nmSifat),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->sfat->update($idSifat, $data);
                $msg = [
                    'sukses' => 'Data sifat surat telah diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $idSifat = $this->request->getPost('idSifat');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->sfat->update($idSifat, $data);
            $msg = [
                'sukses' => 'Data sifat surat telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------
}
