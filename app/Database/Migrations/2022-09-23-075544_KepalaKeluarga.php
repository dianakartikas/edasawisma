<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KepalaKeluarga extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_kk'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_desa'        => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'null'           => TRUE
            ],
            'NIK'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
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
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Wanita Usia Subur', 'Pasangan Usia Subur', 'Ibu Hamil', 'Ibu Menyusui', 'Lanjut Usia', 'Tidak'],
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
            'umur'        => [
                'type'           => 'INT',
                'constraint'     => '5',
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
        $this->forge->addKey('id_kk', TRUE);
        $this->forge->addForeignKey('id_desa', 'desa', 'id_desa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kepalakeluarga');
    }

    public function down()
    {
        $this->forge->dropTable('kepalakeluarga');
    }
}
