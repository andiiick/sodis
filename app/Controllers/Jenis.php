<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Jenis extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Data Jenis Surat',
            'isi'   => 'jenis/v_jenis',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'jenis' => $this->jnis->get_jenis(),
            ];
            $msg = [
                'data' => view('jenis/v_table', $data)
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
                'data' => view('jenis/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdJenis = $this->request->getPost('kdJenis');
            $nmJenis = $this->request->getPost('nmJenis');
            $valid = $this->validate([
                'kdJenis' => [
                    'label' => 'Kode jenis surat <b>' . $kdJenis . '</b>',
                    'rules' => 'required|is_unique[jenis.kdJenis]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmJenis' => [
                    'label' => 'Nama jenis surat <b>' . $nmJenis . '</b>',
                    'rules' => 'required|is_unique[jenis.nmJenis]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdJenis' => $this->validation->getError('kdJenis'),
                        'nmJenis' => $this->validation->getError('nmJenis'),
                    ]
                ];
            } else {
                $data = [
                    'kdJenis'      => strtoupper($kdJenis),
                    'nmJenis'      => ucwords($nmJenis),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->jnis->insert($data);
                $msg = [
                    'sukses' => 'Data jenis surat berhasil ditambahkan'
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
            $idJenis = $this->request->getPost('idJenis');
            $res = $this->jnis->find($idJenis);
            $data = [
                'idJenis' => $res['idJenis'],
                'kdJenis' => $res['kdJenis'],
                'nmJenis' => $res['nmJenis'],
            ];
            $msg = [
                'sukses' => view('jenis/v_modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idJenis = $this->request->getPost('idJenis');
            $kdJenis = $this->request->getPost('kdJenis');
            $nmJenis = $this->request->getPost('nmJenis');

            // $cek = $this->jnis->jenisCheck($idJenis);

            $valid = $this->validate([
                'kdJenis' => [
                    'label' => 'Kode jenis surat <b>' . $kdJenis . '</b>',
                    'rules' => 'required|is_unique[jenis.kdJenis]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmJenis' => [
                    'label' => 'Nama jenis surat <b>' . $nmJenis . '</b>',
                    'rules' => 'required|is_unique[jenis.nmJenis]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdJenis' => $this->validation->getError('kdJenis'),
                        'nmJenis' => $this->validation->getError('nmJenis'),
                    ]
                ];
            } else {
                $data = [
                    'kdJenis'      => strtoupper($kdJenis),
                    'nmJenis'      => ucwords($nmJenis),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->jnis->update($idJenis, $data);
                $msg = [
                    'sukses' => 'Data jenis surat telah diperbaharui'
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
            $idJenis = $this->request->getPost('idJenis');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->jnis->update($idJenis, $data);
            $msg = [
                'sukses' => 'Data jenis surat telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------
}
