<?php

namespace App\Models;

use CodeIgniter\Model;

class anggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['id_kk', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'status', 'kebutaan', 'kebutuhan', 'umur', 'status_hubungan', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function semuaData()
    {
        return $this->db->table('anggota')
            ->select('id_anggota, kepalakeluarga.nama as namakepala, status_hubungan, anggota.jenis_kelamin as jenis_kelamin, anggota.tanggal_lahir as tanggal_lahir, anggota.status as status, anggota.kebutaan as kebutaan, anggota.kebutuhan as kebutuhan, anggota.umur as umur, anggota.nama as nama')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = anggota.id_kk')
            ->get()->getResultArray();
    }
    public function anggotaAdmin()
    {
        return $this->db->table('anggota')
            ->select('id_anggota, desa.nama as namadesa, kepalakeluarga.nama as namakepala, users.id_desa as id_desa, name, status_hubungan, anggota.jenis_kelamin as jenis_kelamin, anggota.tanggal_lahir as tanggal_lahir, anggota.status as status, anggota.kebutaan as kebutaan, anggota.kebutuhan as kebutuhan, anggota.umur as umur, anggota.nama as nama, anggota.id_kk as id_kk')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = anggota.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }


    public function countPUS()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('status');
        $role = 'Pasangan Usia Subur';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countWUS()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('status');
        $role = 'Wanita Usia Subur';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countIM()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('status');
        $role = 'Ibu Menyusui';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countIH()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('status');
        $role = 'Ibu Hamil';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countLU()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('status');
        $role = 'Lanjut Usia';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countButa()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('kebutaan');
        $role = 'Buta';
        $this->builder->where('kebutaan', $role);
        return $this->builder->countAllResults();
    }
    public function countBH()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('kebutaan');
        $role = 'Buta Huruf';
        $this->builder->where('kebutaan', $role);
        return $this->builder->countAllResults();
    }
    public function countBK()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('kebutuhan');
        $role = 'Iya';
        $this->builder->where('kebutuhan', $role);
        return $this->builder->countAllResults();
    }

    public function countBalita()
    {

        $this->builder = $this->db->table('anggota');
        $this->builder->select('umur');
        $umur = 6;
        $this->builder->where('umur <', $umur);
        return $this->builder->countAllResults();
    }
    public function tes1()
    {
        $this->builder = $this->db->table('anggota');
        $this->builder->select('desa.nama as namadesa, kepalakeluarga.id_desa as id_desa, id_anggota, kepalakeluarga.nama as namakepala, status_hubungan, anggota.jenis_kelamin as jenis_kelamin, anggota.tanggal_lahir as tanggal_lahir, anggota.status as status, anggota.kebutaan as kebutaan, anggota.kebutuhan as kebutuhan, anggota.umur as umur, anggota.nama as nama');
        $this->builder->join('kepalakeluarga', 'kepalakeluarga.id_kk = anggota.id_kk');
        $this->builder->join('desa', 'desa.id_desa = kepalakeluarga.id_desa');
        return $this->builder->get()->getResultArray();
    }
}
