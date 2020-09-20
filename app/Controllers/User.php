<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title' => 'Data Pengguna',
            'isi'   => 'user/v_user',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user'  => $this->user->get_user(),
            ];
            $msg = [
                'data' => view('user/v_table', $data)
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
                'data' => view('user/v_modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nip = $this->request->getPost('nip');
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama pengguna',
                    'rules' => 'required[users.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'nip' => [
                    'label' => 'NIP/NKA <b>' . $nip . '</b>',
                    'rules' => 'required|is_unique[users.nip]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'jenisKelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required[users.jenisKelamin]',
                    'errors' => [
                        'required'  => 'Silahkan pilih jenis kelamin',
                    ]
                ],
                'akses' => [
                    'label' => 'Akses',
                    'rules' => 'required[users.akses]',
                    'errors' => [
                        'required'  => 'Silahkan pilih akses pengguna',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'         => $this->validation->getError('nama'),
                        'nip'          => $this->validation->getError('nip'),
                        'jenisKelamin' => $this->validation->getError('jenisKelamin'),
                        'akses'        => $this->validation->getError('akses'),
                    ]
                ];
            } else {
                $data = [
                    'nama'         => ucwords($this->request->getPost('nama')),
                    'nip'          => $nip,
                    'jenisKelamin' => $this->request->getPost('jenisKelamin'),
                    'akses'        => $this->request->getPost('akses'),
                    'password'     => sha1(md5('123456')),
                    'created_user' => session()->get('idUser'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'    => 'normal',
                ];
                $this->user->insert($data);
                $msg = [
                    'sukses' => 'Data pengguna berhasil ditambahkan'
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
            $idUser = $this->request->getPost('idUser');
            $res    = $this->user->find($idUser);
            $data = [
                'idUser'       => $res['idUser'],
                'nama'         => $res['nama'],
                'nip'          => $res['nip'],
                'jenisKelamin' => $res['jenisKelamin'],
                'akses'        => $res['akses'],
            ];
            $msg = [
                'sukses' => view('user/v_modaledit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idUser = $this->request->getPost('idUser');
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama pengguna',
                    'rules' => 'required[users.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'jenisKelamin' => [
                    'label' => 'Jenis kelamin',
                    'rules' => 'required[users.jenisKelamin]',
                    'errors' => [
                        'required'  => 'Silahkan pilih jenis kelamin',
                    ]
                ],
                'akses' => [
                    'label' => 'Akses',
                    'rules' => 'required[users.akses]',
                    'errors' => [
                        'required'  => 'Silahkan pilih akses pengguna',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'         => $this->validation->getError('nama'),
                        'jenisKelamin' => $this->validation->getError('jenisKelamin'),
                        'akses'        => $this->validation->getError('akses'),
                    ]
                ];
            } else {
                $data = [
                    'nama'         => ucwords($this->request->getPost('nama')),
                    'nip'          => $this->request->getPost('nip'),
                    'jenisKelamin' => $this->request->getPost('jenisKelamin'),
                    'akses'        => $this->request->getPost('akses'),
                    'updated_user' => session()->get('idUser'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->user->update($idUser, $data);
                $msg = [
                    'sukses' => 'Data pengguna telah diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function deactive()
    {
        if ($this->request->isAJAX()) {
            $idUser = $this->request->getPost('idUser');
            $data = [
                'status_cd' => 'deactive',
            ];
            $this->user->update($idUser, $data);
            $msg = [
                'sukses' => 'Data pengguna telah di nonaktifkan'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function active()
    {
        if ($this->request->isAJAX()) {
            $idUser = $this->request->getPost('idUser');
            $data = [
                'status_cd' => 'normal',
            ];
            $this->user->update($idUser, $data);
            $msg = [
                'sukses' => 'Data pengguna telah di aktifkan'
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
