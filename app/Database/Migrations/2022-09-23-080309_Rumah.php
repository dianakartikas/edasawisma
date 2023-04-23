<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rumah extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_rumah'            => [
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
            'pembuangan-sampah' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya', 'Tidak'],
                'default'       => 'Iya',
            ],
            'spal' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya', 'Tidak'],
                'default'       => 'Iya',
            ],
            'jamban-keluarga' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya', 'Tidak'],
                'default'       => 'Iya',
            ],
            'gambar_rumah'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
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
        $this->forge->addKey('id_rumah', TRUE);
        $this->forge->addForeignKey('id_kk', 'kepalakeluarga', 'id_kk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rumah');
    }

    public function down()
    {
        $this->forge->dropTable('rumah');
    }
}
