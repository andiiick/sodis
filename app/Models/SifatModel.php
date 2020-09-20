<?php

namespace App\Models;

use CodeIgniter\Model;

class SifatModel extends Model
{
    protected $table         = 'sifat';
    protected $primaryKey    = 'idSifat';
    protected $allowedFields = ['idSifat', 'nmSifat', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_sifat()
    {
        return $this->db->table('sifat')
            ->where('status_cd', 'normal')
            ->orderBy('nmSifat', 'ASC')
            ->get()->getResultArray();
    }

    public function sifatCheck($idSifat)
    {
        return $this->db->table('sifat')
            ->where(array('idSifat' => $idSifat))
            ->get()->getRowArray();
    }
}
