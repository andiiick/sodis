<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'idUser';
    protected $allowedFields = ['idUser', 'nip', 'pin', 'idJabatan', 'nama', 'jenisKelamin', 'password', 'email', 'telepon', 'alamat', 'akses', 'foto', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_user()
    {
        return $this->db->table('users a')
            ->select('a.idUser,a.nip,b.kdJabatan,b.nmJabatan,a.nama,a.jenisKelamin,a.foto,a.status_cd')
            ->join('jabatan b', 'a.idJabatan=b.idJabatan', 'left')
            ->where('a.status_cd !=', 'nullified')
            ->orderBy('b.kdJabatan', 'ASC')
            ->get()->getResultArray();
    }
}
