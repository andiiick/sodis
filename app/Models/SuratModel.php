<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table         = 'surat';
    protected $primaryKey    = 'idSurat';
    protected $allowedFields = ['idSurat', 'tipe', 'trackID', 'noUrut', 'koresponden', 'noSurat', 'tglSurat', 'tglTerima', 'tglTempo', 'idKlas', 'idJenis', 'idSifat', 'perihal', 'isi', 'fileSurat', 'fileSurat_view', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm', 'status_surat', 'status_respon', 'pagette', 'tglSelesai'];

    public function get_suratmasuk()
    {
        return $this->db->table('surat a')
            ->select('a.idSurat,a.tipe,a.trackID,a.noUrut,a.koresponden,a.noSurat,a.tglSurat,a.tglTerima,a.tglTempo,
                      b.kdKlas,b.nmKlas,
                      c.kdJenis,c.nmJenis,
                      d.nmSifat,
                      a.perihal,a.isi,a.fileSurat,a.fileSurat_view,
                      a.created_user,a.created_dttm,a.updated_user,a.updated_dttm,a.nullified_user,a.nullified_dttm,
                      a.status_surat,a.status_respon,a.pagette,a.tglSelesai')
            ->join('klasifikasi b', 'a.idKlas=b.idKlas', 'left')
            ->join('jenis c', 'a.idJenis=c.idJenis', 'left')
            ->join('sifat d', 'a.idSifat=d.idSifat', 'left')
            ->where('a.tipe', 'IN')
            ->where('a.status_surat !=', 'nullified')
            ->orderBy('a.created_dttm', 'DESC')
            ->get()->getResultArray();
    }
}
