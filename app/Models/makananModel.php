<?php

namespace App\Models;

use CodeIgniter\Model;

class makananModel extends Model
{
    protected $table = 'makanan';
    protected $primaryKey = 'id_makanan';
    protected $allowedFields = ['id_makanan', 'id_kk', 'makanan_pokok','keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    public function semuaData()
    {
        return $this->db->table('makanan')
            ->select('kepalakeluarga.nama as nama, id_makanan, makanan_pokok, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = makanan.id_kk')
            ->get()->getResultArray();
    }
    public function makananAdmin()
    {
        return $this->db->table('makanan')
            ->select('kepalakeluarga.nama as nama, id_makanan, makanan_pokok, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = makanan.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }

}