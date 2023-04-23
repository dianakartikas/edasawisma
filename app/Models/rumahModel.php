<?php

namespace App\Models;

use CodeIgniter\Model;

class rumahModel extends Model
{
    protected $table = 'rumah';
    protected $primaryKey = 'id_rumah';
    protected $allowedFields = ['id_rumah', 'id_kk', 'pembuangan_sampah','stiker_pkk', 'spal', 'jamban_keluarga', 'gambar_rumah','keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function semuaData()
    {
        return $this->db->table('rumah')
            ->select('kepalakeluarga.nama as nama, id_rumah, stiker_pkk, pembuangan_sampah, spal, jamban_keluarga, gambar_rumah, keterangan, rumah.updated_at as updated_at')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = rumah.id_kk')
            ->get()->getResultArray();
    }
   
    public function rumahAdmin()
    {
        return $this->db->table('rumah')
            ->select('kepalakeluarga.nama as nama, id_rumah, pembuangan_sampah,  stiker_pkk, spal, jamban_keluarga, gambar_rumah, keterangan, rumah.updated_at as updated_at')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = rumah.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }
}