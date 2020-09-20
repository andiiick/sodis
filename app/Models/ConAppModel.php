<?php

namespace app\Models;

use CodeIgniter\Model;

class ConAppModel extends Model
{
    protected $table         = 'sys_config';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id', 'nama', 'telepon', 'apikeys', 'email', 'website', 'logo', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_conapp()
    {
        return $this->db->table('sys_config')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function conappCheck($id)
    {
        return $this->db->table('sys_config')
            ->where(array('id' => $id))
            ->limit(1)
            ->get()->getRowArray();
    }
}
