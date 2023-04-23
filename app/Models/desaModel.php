<?php

namespace App\Models;

use CodeIgniter\Model;

class desaModel extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id_desa';
    protected $allowedFields = ['id_desa', 'nama'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function desaAdmin()
    {
        return $this->db->table('desa')
            ->select('nama, users.id_desa as id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }


}