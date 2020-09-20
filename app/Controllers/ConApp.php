<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConApp extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title'    => 'Konfigurasi Aplikasi',
            'isi'      => 'conApp/v_conApp',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'conapp'  => $this->conf->get_conapp(),
            ];
            $msg = [
                'data' => view('conApp/v_form', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama aplikasi',
                    'rules' => 'required[sys_config.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'telepon' => [
                    'label' => 'No. Telepon',
                    'rules' => 'required[sys_config.telepon]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'email' => [
                    'label' => 'e-Mail',
                    'rules' => 'required[sys_config.email]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'website' => [
                    'label' => 'Website',
                    'rules' => 'required[sys_config.website]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'logo' => [
                    'label' => 'Logo',
                    'rules' => 'max_size[logo,3072]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'    => $this->validation->getError('nama'),
                        'telepon' => $this->validation->getError('telepon'),
                        'email'   => $this->validation->getError('email'),
                        'website' => $this->validation->getError('website'),
                        'logo'    => $this->validation->getError('logo'),
                    ]
                ];
            } else {
                $fileImg = $this->request->getFile('logo');
                $logoLama = $this->request->getPost('logoLama');

                if ($fileImg->getError() == 4) {
                    $logo = $logoLama;
                } else {
                    $logo = $fileImg->getRandomName();
                    $fileImg->move('img/aplikasi', $logo);
                    if ($logoLama != 'no_image.png') {
                        unlink('img/aplikasi/' . $logoLama);
                    }
                }

                $data = [
                    'nama'    => $this->request->getPost('nama'),
                    'telepon' => $this->request->getPost('telepon'),
                    'email'   => $this->request->getPost('email'),
                    'website' => $this->request->getPost('website'),
                    'logo'    => $logo,
                ];
                $this->conf->update($id, $data);
                $msg = [
                    'sukses' => 'Data aplikasi telah diperbaharui'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function ambil_logo()
    {
        $id = 1;
        $cek = $this->conf->conappCheck($id);
        $logo = $cek['logo'];
        $msg = array('logo' => $logo);
        return $this->response->setJSON($msg);
    }
}
