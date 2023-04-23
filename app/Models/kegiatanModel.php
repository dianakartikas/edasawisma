<?php

namespace App\Models;

use CodeIgniter\Model;

class kegiatanModel extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $allowedFields = ['id_kegiatan', 'id_kk', 'up2k', 'irt', 'kb', 'plp','keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function semuaData()
    {
        return $this->db->table('kegiatan')
            ->select('kepalakeluarga.nama as nama, id_kegiatan, up2k, irt, kb, plp,keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = kegiatan.id_kk')
            ->get()->getResultArray();
    }

    public function kegiatanAdmin()
    {
        return $this->db->table('kegiatan')
            ->select('kepalakeluarga.nama as nama, id_kegiatan, up2k, irt, kb, plp,keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = kegiatan.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }
}
