<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table         = 'jenis';
    protected $primaryKey    = 'idJenis';
    protected $allowedFields = ['idJenis', 'kdJenis', 'nmJenis', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_jenis()
    {
        return $this->db->table('jenis')
            ->where('status_cd', 'normal')
            ->orderBy('kdJenis', 'ASC')
            ->get()->getResultArray();
    }

    public function jenisCheck($idJenis)
    {
        return $this->db->table('jenis')
            ->where(array('idJenis' => $idJenis))
            ->get()->getRowArray();
    }
}
