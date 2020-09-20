<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table         = 'jabatan';
    protected $primaryKey    = 'idJabatan';
    protected $allowedFields = ['idJabatan', 'kdJabatan', 'nmJabatan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_jabatan()
    {
        return $this->db->table('jabatan')
            ->where('status_cd', 'normal')
            ->orderBy('kdJabatan', 'ASC')
            ->get()->getResultArray();
    }
}
