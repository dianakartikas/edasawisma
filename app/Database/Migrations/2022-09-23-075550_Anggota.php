<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggota extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_anggota'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_kk'        => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'           => TRUE
            ],
            'nama'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan'],
                'default'    => 'perempuan',
            ],
            'tanggal_lahir'        => [
                'type'           => 'DATE',
            ],
            'umur'        => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'status_hubungan' => [
                'type'       => 'ENUM',
                'constraint' => ['istri', 'anak'],
                'default'    => 'istri',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Wanita Usia Subur', 'Pasangan Usia Subur', 'Ibu Hamil', 'Ibu Menyusui', 'Lanjut Usia', 'Balita', 'Tidak'],
                'default'    => 'Pasangan Usia Subur',
            ],
            'kebutaan' => [
                'type'       => 'ENUM',
                'constraint' => ['Tidak Buta', 'Buta Huruf', 'Buta'],
                'default'    => 'Tidak Buta',
            ],
            'kebutuhan' => [
                'type'       => 'ENUM',
                'constraint' => ['Iya', 'Tidak'],
                'default'    => 'Tidak',
            ],
            'created_at'       => [
                'type'           => 'DATETIME',
                // 'default'        => 'current_timestamp()',
            ],
            'updated_at'       => [
                'type'           => 'DATETIME',
                // 'default'        => 'current_timestamp()',
            ]
        ]);
        $this->forge->addKey('id_anggota', TRUE);
        $this->forge->addForeignKey('id_kk', 'kepalakeluarga', 'id_kk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}
