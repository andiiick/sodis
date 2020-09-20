<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Company extends BaseController
{
    public function index()
    {
        if (session()->get('nip') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'title'    => 'Instansi',
            'isi'      => 'company/v_company',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'company'  => $this->comp->get_company(),
            ];
            $msg = [
                'data' => view('company/v_form', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $co_id = $this->request->getPost('co_id');

            $valid = $this->validate([
                'co_nm' => [
                    'label' => 'Nama instansi',
                    'rules' => 'required[tbl_company.co_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'co_phone' => [
                    'label' => 'No. Telepon',
                    'rules' => 'required[tbl_company.co_phone]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'co_email' => [
                    'label' => 'e-Mail',
                    'rules' => 'required[tbl_company.co_email]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'co_address' => [
                    'label' => 'Alamat',
                    'rules' => 'required[tbl_company.co_address]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'co_logo' => [
                    'label' => 'Logo',
                    'rules' => 'max_size[co_logo,3072]|is_image[co_logo]|mime_in[co_logo,image/jpg,image/jpeg,image/png]',
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
                        'co_nm'      => $this->validation->getError('co_nm'),
                        'co_phone'   => $this->validation->getError('co_phone'),
                        'co_email'   => $this->validation->getError('co_email'),
                        'co_address' => $this->validation->getError('co_address'),
                        'co_logo'    => $this->validation->getError('co_logo'),
                    ]
                ];
            } else {
                $fileImg = $this->request->getFile('co_logo');
                $logoLama = $this->request->getPost('logoLama');

                if ($fileImg->getError() == 4) {
                    $co_logo = $logoLama;
                } else {
                    $co_logo = $fileImg->getRandomName();
                    $fileImg->move('img/company', $co_logo);
                    if ($logoLama != 'no_image.png') {
                        unlink('img/company/' . $logoLama);
                    }
                }

                $data = [
                    'co_nm'      => $this->request->getPost('co_nm'),
                    'co_phone'   => $this->request->getPost('co_phone'),
                    'co_email'   => $this->request->getPost('co_email'),
                    'co_address' => $this->request->getPost('co_address'),
                    'co_logo'    => $co_logo,
                ];
                $this->comp->update($co_id, $data);
                $msg = [
                    'sukses' => 'Data instansi berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function ambil_logo()
    {
        $co_id = 1;
        $coCek = $this->comp->companyCheck($co_id);
        $logo = $coCek['co_logo'];
        $msg = array('logo' => $logo);
        return $this->response->setJSON($msg);
    }
}
