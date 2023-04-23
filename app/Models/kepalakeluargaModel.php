<?php

namespace App\Models;

use CodeIgniter\Model;

class kepalakeluargaModel extends Model
{
    protected $table = 'kepalakeluarga';
    protected $primaryKey = 'id_kk';
    protected $allowedFields = ['id_kk', 'nik', 'id_desa', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'status', 'kebutaan', 'kebutuhan', 'umur'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function semuaData()
    {
        return $this->db->table('kepalakeluarga')
            ->select('desa.nama as namadesa, kepalakeluarga.id_desa as id_desa, nik, jenis_kelamin, tanggal_lahir, status, kebutaan, kebutuhan, umur, kepalakeluarga.nama as nama, id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->get()->getResultArray();
    }

    public function countKKDesa($id)
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('id_kk, desa.nama as nama');
        $this->builder->join('desa', 'desa.id_desa = kepalakeluarga.id_desa');
        $this->builder->where('id_desa', $id);

        return $this->builder->countAllResults();
    }
    public function getDataById($id)
    {
        return $this->db->table('kepalakeluarga')
            ->select('desa.nama as namadesa, id_desa, nik, jenis_kelamin, tanggal_lahir, status, kebutaan, kebutuhan, umur, kepalakeluarga.nama as nama, id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->where('kepalakeluarga.id_kk', $id)
            ->get()->getResultArray();
    }
    public function getDataByDesa()
    {
        return $this->db->table('kepalakeluarga')
            ->select('kepalakeluarga.id_kk, desa.nama as nama')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')

            ->get()->getResultArray();
    }
    public function kepalaKeluargaAdmin()
    {
        return $this->db->table('kepalakeluarga')
            ->select('desa.nama as namadesa, users.id_desa as id_desa, name, nik, jenis_kelamin, tanggal_lahir, kepalakeluarga.status as status, kebutaan, kebutuhan, umur, kepalakeluarga.nama as nama, id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id())
            ->get()->getResultArray();
    }
    public function cetakData()
    {
        $query = $this->db->query("SELECT rumah.keterangan as ket, kepalakeluarga.nama, kepalakeluarga.jenis_kelamin= 'laki-laki' as jenis_kelaminkk1, 
        kepalakeluarga.jenis_kelamin= 'perempuan' as jenis_kelaminkk2, SUM(anggota.jenis_kelamin= 'laki-laki') as jenis_kelamin1, 
        SUM(anggota.jenis_kelamin= 'perempuan') as jenis_kelamin2, 
        SUM(anggota.jenis_kelamin= 'laki-laki' AND anggota.status= 'balita') as balitalaki, 
        SUM(anggota.jenis_kelamin= 'perempuan' AND anggota.status= 'balita') as balitaperempuan, 
        SUM(anggota.status='Pasangan Usia Subur') as psu, SUM(anggota.status='Wanita Usia Subur') as wus, SUM(anggota.status='Ibu Hamil') as ih, 
        SUM(anggota.status='Ibu Menyusui') as im, SUM(anggota.status='Lanjut Usia') as lu, 
        kepalakeluarga.status='Pasangan Usia Subur' as psu2, kepalakeluarga.status='Wanita Usia Subur' as wus2, kepalakeluarga.status='Ibu Hamil' as ih2, 
        kepalakeluarga.status='Ibu Menyusui' as im2, kepalakeluarga.status='Lanjut Usia' as lu2, 
        SUM(anggota.kebutaan='Buta') as buta1, SUM(anggota.kebutaan='Buta Huruf') as butah1, 
        SUM(kepalakeluarga.kebutaan='Buta') as buta2, SUM(kepalakeluarga.kebutaan='Buta Huruf') as butah2, SUM(anggota.kebutuhan='Iya') as spesial1, 
        kepalakeluarga.kebutuhan='Iya' as spesial2, rumah.pembuangan_sampah='Iya' as ps, rumah.spal='Iya' as spal, rumah.stiker_pkk='Iya' as stikerpkk,
        rumah.jamban_keluarga='Iya' as jk, air.pdam='Iya' as pdam, air.sumur='Iya' as sumur,
        makanan.makanan_pokok='Nasi' as beras, makanan.makanan_pokok!='Nasi' as nonberas,
        kegiatan.up2k='Iya' as up2k, kegiatan.plp='Iya' as plp, kegiatan.irt='Iya' as irt,kegiatan.kb='Iya' as kb,
        desa.nama as namadesa
        FROM kepalakeluarga 
        LEFT JOIN anggota on kepalakeluarga.id_kk=anggota.id_kk
        LEFT JOIN desa on kepalakeluarga.id_desa=desa.id_desa 
        LEFT JOIN rumah on kepalakeluarga.id_kk=rumah.id_kk 
        LEFT JOIN air on kepalakeluarga.id_kk=air.id_kk  
        LEFT JOIN makanan on kepalakeluarga.id_kk=makanan.id_kk 
        LEFT JOIN kegiatan on kepalakeluarga.id_kk=kegiatan.id_kk

        GROUP BY kepalakeluarga.id_kk");

        return $query->getResultArray();
    }

    public function cetakDataDesa()
    {

        $user = user_id();
        $query = $this->db->query("SELECT rumah.keterangan as ket, kepalakeluarga.nama, kepalakeluarga.jenis_kelamin= 'laki-laki' as jenis_kelaminkk1, 
        kepalakeluarga.jenis_kelamin= 'perempuan' as jenis_kelaminkk2, SUM(anggota.jenis_kelamin= 'laki-laki') as jenis_kelamin1, 
        SUM(anggota.jenis_kelamin= 'perempuan') as jenis_kelamin2, 
        SUM(anggota.jenis_kelamin= 'laki-laki' AND anggota.status= 'balita') as balitalaki, 
        SUM(anggota.jenis_kelamin= 'perempuan' AND anggota.status= 'balita') as balitaperempuan, 
        SUM(anggota.status='Pasangan Usia Subur') as psu, SUM(anggota.status='Wanita Usia Subur') as wus, SUM(anggota.status='Ibu Hamil') as ih, 
        SUM(anggota.status='Ibu Menyusui') as im, SUM(anggota.status='Lanjut Usia') as lu, 
        kepalakeluarga.status='Pasangan Usia Subur' as psu2, kepalakeluarga.status='Wanita Usia Subur' as wus2, kepalakeluarga.status='Ibu Hamil' as ih2, 
        kepalakeluarga.status='Ibu Menyusui' as im2, kepalakeluarga.status='Lanjut Usia' as lu2, 
        SUM(anggota.kebutaan='Buta') as buta1, SUM(anggota.kebutaan='Buta Huruf') as butah1, 
        SUM(kepalakeluarga.kebutaan='Buta') as buta2, SUM(kepalakeluarga.kebutaan='Buta Huruf') as butah2, SUM(anggota.kebutuhan='Iya') as spesial1, 
        kepalakeluarga.kebutuhan='Iya' as spesial2, rumah.pembuangan_sampah='Iya' as ps, rumah.spal='Iya' as spal, rumah.stiker_pkk='Iya' as stikerpkk,
        rumah.jamban_keluarga='Iya' as jk, air.pdam='Iya' as pdam, air.sumur='Iya' as sumur,
        makanan.makanan_pokok='Nasi' as beras, makanan.makanan_pokok!='Nasi' as nonberas,
        kegiatan.up2k='Iya' as up2k, kegiatan.plp='Iya' as plp, kegiatan.irt='Iya' as irt,kegiatan.kb='Iya' as kb,
        desa.nama as namadesa

        FROM kepalakeluarga 
        LEFT JOIN anggota on kepalakeluarga.id_kk=anggota.id_kk
        LEFT JOIN desa on kepalakeluarga.id_desa=desa.id_desa 
        LEFT JOIN rumah on kepalakeluarga.id_kk=rumah.id_kk 
        LEFT JOIN air on kepalakeluarga.id_kk=air.id_kk  
        LEFT JOIN makanan on kepalakeluarga.id_kk=makanan.id_kk 
        LEFT JOIN kegiatan on kepalakeluarga.id_kk=kegiatan.id_kk
         JOIN users on kepalakeluarga.id_desa=users.id_desa 
        WHERE users.id = $user
        GROUP BY kepalakeluarga.id_kk");
        return $query->getResultArray();
    }
    public function countPUS()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('status');
        $role = 'Pasangan Usia Subur';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countWUS()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('status');
        $role = 'Wanita Usia Subur';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countIM()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('status');
        $role = 'Ibu Menyusui';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countIH()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('status');
        $role = 'Ibu Hamil';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countLU()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('status');
        $role = 'Lanjut Usia';
        $this->builder->where('status', $role);
        return $this->builder->countAllResults();
    }
    public function countButa()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('kebutaan');
        $role = 'Buta';
        $this->builder->where('kebutaan', $role);
        return $this->builder->countAllResults();
    }
    public function countBH()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('kebutaan');
        $role = 'Buta Huruf';
        $this->builder->where('kebutaan', $role);
        return $this->builder->countAllResults();
    }
    public function countBK()
    {

        $this->builder = $this->db->table('kepalakeluarga');
        $this->builder->select('kebutuhan');
        $role = 'Iya';
        $this->builder->where('kebutuhan', $role);
        return $this->builder->countAllResults();
    }
}
