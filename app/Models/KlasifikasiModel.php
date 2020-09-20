<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    protected $table         = 'klasifikasi';
    protected $primaryKey    = 'idKlas';
    protected $allowedFields = ['idKlas', 'kdKlas', 'nmKlas', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_klas()
    {
        return $this->db->table('klasifikasi')
            ->where('status_cd', 'normal')
            ->orderBy('kdKlas', 'ASC')
            ->get()->getResultArray();
    }

    public function klasCheck($idKlas)
    {
        return $this->db->table('klasifikasi')
            ->where(array('idKlas' => $idKlas))
            ->get()->getRowArray();
    }
}
