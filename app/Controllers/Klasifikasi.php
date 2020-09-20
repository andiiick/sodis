<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Klasifikasi extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Data Klasifikasi Surat',
            'isi'   => 'klasifikasi/v_klasifikasi',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'klasifikasi' => $this->klas->get_klas(),
            ];
            $msg = [
                'data' => view('klasifikasi/v_table', $data)
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
                'data' => view('klasifikasi/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdKlas = $this->request->getPost('kdKlas');
            $nmKlas = $this->request->getPost('nmKlas');
            $valid = $this->validate([
                'kdKlas' => [
                    'label' => 'Kode klasifikasi surat <b>' . $kdKlas . '</b>',
                    'rules' => 'required|is_unique[klasifikasi.kdKlas]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmKlas' => [
                    'label' => 'Nama klasifikasi surat <b>' . $nmKlas . '</b>',
                    'rules' => 'required|is_unique[klasifikasi.nmKlas]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdKlas' => $this->validation->getError('kdKlas'),
                        'nmKlas' => $this->validation->getError('nmKlas'),
                    ]
                ];
            } else {
                $data = [
                    'kdKlas'       => strtoupper($kdKlas),
                    'nmKlas'       => ucwords($nmKlas),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->klas->insert($data);
                $msg = [
                    'sukses' => 'Data klasifikasi surat berhasil ditambahkan'
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
            $idKlas = $this->request->getPost('idKlas');
            $res = $this->klas->find($idKlas);
            $data = [
                'idKlas' => $res['idKlas'],
                'kdKlas' => $res['kdKlas'],
                'nmKlas' => $res['nmKlas'],
            ];
            $msg = [
                'sukses' => view('klasifikasi/v_modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idKlas = $this->request->getPost('idKlas');
            $kdKlas = $this->request->getPost('kdKlas');
            $nmKlas = $this->request->getPost('nmKlas');

            $cek = $this->klas->klasCheck($idKlas);

            $valid = $this->validate([
                'kdKlas' => [
                    'label' => 'Kode klasifikasi surat <b>' . $kdKlas . '</b>',
                    'rules' => 'required|is_unique[klasifikasi.kdKlas]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmKlas' => [
                    'label' => 'Nama klasifikasi surat <b>' . $nmKlas . '</b>',
                    'rules' => 'required|is_unique[klasifikasi.nmKlas]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdKlas' => $this->validation->getError('kdKlas'),
                        'nmKlas' => $this->validation->getError('nmKlas'),
                    ]
                ];
            } else {
                $data = [
                    'kdKlas'       => strtoupper($kdKlas),
                    'nmKlas'       => ucwords($nmKlas),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->klas->update($idKlas, $data);
                $msg = [
                    'sukses' => 'Data klasifikasi surat telah diperbaharui'
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
            $idKlas = $this->request->getPost('idKlas');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->klas->update($idKlas, $data);
            $msg = [
                'sukses' => 'Data klasifikasi surat telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------
}
