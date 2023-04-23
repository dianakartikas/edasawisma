<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Models\UserModel as MythModel;

class UserModel extends MythModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'Myth\Auth\Entities\User';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $allowedFields = [
        'email', 'username', 'id_desa', 'user_image', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at'
    ];
    public function lihatPassword()
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid, password_hash');
        $this->builder->where('users.id', user_id());
        return $this->builder->get()->getRow();
    }
    public function daftarPengguna()
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid, username, email, name, desa.id_desa as id_desa, group_id, password_hash, COUNT(kepalakeluarga.id_kk) as jumlahkk, COUNT(anggota.id_kk) as jumlahanggota, COUNT(rumah.id_kk) as jumlahrumah, COUNT(air.id_kk) as jumlahair, COUNT(makanan.id_kk) as jumlahmakanan, COUNT(kegiatan.id_kk) as jumlahkegiatan');
        $this->builder->join('desa', 'desa.id_desa = users.id', 'left');
        $this->builder->join('kepalakeluarga', 'desa.id_desa = kepalakeluarga.id_desa', 'left');
        $this->builder->join('anggota', 'kepalakeluarga.id_kk = anggota.id_kk', 'left');
        $this->builder->join('rumah', 'kepalakeluarga.id_kk = rumah.id_kk', 'left');
        $this->builder->join('air', 'kepalakeluarga.id_kk = air.id_kk', 'left');
        $this->builder->join('makanan', 'kepalakeluarga.id_kk = makanan.id_kk', 'left');
        $this->builder->join('kegiatan', 'kepalakeluarga.id_kk = kegiatan.id_kk', 'left');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id');
        $this->builder->where('name=', 'admin');
        $this->builder->groupBy('id_desa');
        return $this->builder->get()->getResult();
    }
    public function lihatProfile()
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid, username, email, name, users.id_desa as id_desa, group_id, nama');
        $this->builder->join('desa', 'desa.id_desa = users.id_desa');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id');
        $this->builder->where('users.id', user_id());
        return $this->builder->get()->getResult();
    }
}
