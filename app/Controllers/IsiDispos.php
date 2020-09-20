<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IsiDispos extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Data Isi Disposisi Surat',
            'isi'   => 'isiDispos/v_isiDispos',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'isi' => $this->isi->get_isi(),
            ];
            $msg = [
                'data' => view('isiDispos/v_table', $data)
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
                'data' => view('isiDispos/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nmDisposisi = $this->request->getPost('nmDisposisi');
            $valid = $this->validate([
                'nmDisposisi' => [
                    'label' => 'Nama isi disposisi <b>' . $nmDisposisi . '</b>',
                    'rules' => 'required|is_unique[isi_disposisi.nmDisposisi]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nmDisposisi' => $this->validation->getError('nmDisposisi'),
                    ]
                ];
            } else {
                $data = [
                    'nmDisposisi'  => ucwords($nmDisposisi),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->isi->insert($data);
                $msg = [
                    'sukses' => 'Data isi disposisi berhasil ditambahkan'
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
            $idIsi = $this->request->getPost('idIsi');
            $res = $this->isi->find($idIsi);
            $data = [
                'idIsi'       => $res['idIsi'],
                'nmDisposisi' => $res['nmDisposisi'],
            ];
            $msg = [
                'sukses' => view('isiDispos/v_modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idIsi       = $this->request->getPost('idIsi');
            $nmDisposisi = $this->request->getPost('nmDisposisi');

            // $cek = $this->isi->sifatCheck($idIsi);

            $valid = $this->validate([
                'nmDisposisi' => [
                    'label' => 'Nama isi disposisi <b>' . $nmDisposisi . '</b>',
                    'rules' => 'required|is_unique[isi_disposisi.nmDisposisi]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nmDisposisi' => $this->validation->getError('nmDisposisi'),
                    ]
                ];
            } else {
                $data = [
                    'nmDisposisi'  => ucwords($nmDisposisi),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->isi->update($idIsi, $data);
                $msg = [
                    'sukses' => 'Data isi disposisi telah diperbaharui'
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
            $idIsi = $this->request->getPost('idIsi');
            $data = [
                'nullified_user' => session()->get('idUser'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->isi->update($idIsi, $data);
            $msg = [
                'sukses' => 'Data isi disposisi telah dihapus'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------
}
