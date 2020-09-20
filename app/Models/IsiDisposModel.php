<?php

namespace App\Models;

use CodeIgniter\Model;

class IsiDisposModel extends Model
{
    protected $table         = 'isi_disposisi';
    protected $primaryKey    = 'idIsi';
    protected $allowedFields = ['idIsi', 'nmDisposisi', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_isi()
    {
        return $this->db->table('isi_disposisi')
            ->where('status_cd', 'normal')
            ->orderBy('nmDisposisi', 'ASC')
            ->get()->getResultArray();
    }

    public function sifatCheck($idIsi)
    {
        return $this->db->table('isi_disposisi')
            ->where(array('idIsi' => $idIsi))
            ->get()->getRowArray();
    }
}
