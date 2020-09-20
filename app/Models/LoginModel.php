<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function loginCheck($nip, $password)
    {
        // return $this->db->table('users')
        //     ->where(array('nip' => $nip, 'password' => $password))
        //     ->get()->getRowArray();

        return $this->db->table('users a')
            ->select('a.idUser,a.nip,a.pin,b.kdJabatan,b.nmJabatan,a.nama,a.jenisKelamin,a.password,a.email,a.telepon,a.alamat,a.akses,a.foto,a.status_cd')
            ->join('jabatan b', 'a.idJabatan=b.idJabatan')
            ->where(array('nip' => $nip, 'password' => $password))
            ->get()->getRowArray();
    }
}
