<?php

namespace app\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table         = 'tbl_company';
    protected $primaryKey    = 'co_id';
    protected $allowedFields = ['co_id', 'co_nm', 'co_phone', 'co_email', 'co_address', 'co_logo'];

    public function get_company()
    {
        return $this->db->table('tbl_company')
            ->orderBy('co_id', 'DESC')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function companyCheck($co_id)
    {
        return $this->db->table('tbl_company')
            ->where(array('co_id' => $co_id))
            ->limit(1)
            ->get()->getRowArray();
    }
}
