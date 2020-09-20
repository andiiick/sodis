<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Jabatan extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title'    => 'Data Jabatan',
            'isi'      => 'jabatan/v_jabatan',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'jabatan'  => $this->jabs->get_jabatan(),
            ];
            $msg = [
                'data' => view('jabatan/v_table', $data)
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
                'data' => view('jabatan/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdJabatan = $this->request->getPost('kdJabatan');
            $nmJabatan = $this->request->getPost('nmJabatan');
            $valid = $this->validate([
                'kdJabatan' => [
                    'label' => 'Kode jabatan <b>' . $kdJabatan . '</b>',
                    'rules' => 'required|is_unique[jabatan.kdJabatan]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmJabatan' => [
                    'label' => 'Nama jabatan <b>' . $nmJabatan . '</b>',
                    'rules' => 'required|is_unique[jabatan.nmJabatan]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdJabatan' => $this->validation->getError('kdJabatan'),
                        'nmJabatan' => $this->validation->getError('nmJabatan'),
                    ]
                ];
            } else {
                $data = [
                    'kdJabatan'    => strtoupper($kdJabatan),
                    'nmJabatan'    => ucwords($nmJabatan),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->jabs->insert($data);
                $msg = [
                    'sukses' => 'Data jabatan berhasil ditambahkan'
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
            $idJabatan = $this->request->getPost('idJabatan');
            $res = $this->jabs->find($idJabatan);
            $data = [
                'idJabatan' => $res['idJabatan'],
                'kdJabatan' => $res['kdJabatan'],
                'nmJabatan' => $res['nmJabatan'],
            ];
            $msg = [
                'sukses' => view('jabatan/v_modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idJabatan = $this->request->getPost('idJabatan');
            $kdJabatan = $this->request->getPost('kdJabatan');
            $nmJabatan = $this->request->getPost('nmJabatan');

            $valid = $this->validate([
                'kdJabatan' => [
                    'label' => 'Kode jabatan <b>' . $kdJabatan . '</b>',
                    'rules' => 'required|is_unique[jabatan.kdJabatan]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'nmJabatan' => [
                    'label' => 'Nama jabatan <b>' . $nmJabatan . '</b>',
                    'rules' => 'required|is_unique[jabatan.nmJabatan]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kdJabatan' => $this->validation->getError('kdJabatan'),
                        'nmJabatan' => $this->validation->getError('nmJabatan'),
                    ]
                ];
            } else {
                $data = [
                    'kdJabatan'    => strtoupper($kdJabatan),
                    'nmJabatan'    => ucwords($nmJabatan),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->jabs->update($idJabatan, $data);
                $msg = [
                    'sukses' => 'Data jabatan telah diperbaharui'
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
            $idJabatan = $this->request->getPost('idJabatan');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->jabs->update($idJabatan, $data);
            $msg = [
                'sukses' => 'Data kategori telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------

}
