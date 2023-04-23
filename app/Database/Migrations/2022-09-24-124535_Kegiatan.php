<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kegiatan extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_kegiatan'         => [
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
            'up2k' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya','Tidak'],
                'default'       => 'Iya',
            ],
            'plp' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya','Tidak'],
                'default'       => 'Iya',
            ],
            'irt' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya','Tidak'],
                'default'       => 'Iya',
            ],
            'kb' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya','Tidak'],
                'default'       => 'Iya',
            ],
            'keterangan'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '25',
                'null'          => TRUE,
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
        $this->forge->addKey('id_kegiatan', TRUE);
        $this->forge->addForeignKey('id_kk', 'kepalakeluarga', 'id_kk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('kegiatan');
    }
}
