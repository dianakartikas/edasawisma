<?php

namespace App\Models;

use CodeIgniter\Model;

class airModel extends Model
{
    protected $table = 'air';
    protected $primaryKey = 'id_air';
    protected $allowedFields = ['id_air', 'id_kk', 'pdam', 'sumur', 'keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function semuaData()
    {
        return $this->db->table('air')
            ->select('kepalakeluarga.nama as nama, id_air, pdam, sumur, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = air.id_kk')
            ->get()->getResultArray();
    }
    public function airAdmin()
    {
        return $this->db->table('air')
            ->select('kepalakeluarga.nama as nama, id_air, pdam, sumur, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = air.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }

}