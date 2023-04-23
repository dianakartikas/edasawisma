<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Air extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_air'         => [
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
            'pdam' => [
                'type'          => 'ENUM',
                'constraint'    => ['Iya','Tidak'],
                'default'       => 'Iya',
            ],
            'sumur' => [
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
        $this->forge->addKey('id_air', TRUE);
        $this->forge->addForeignKey('id_kk', 'kepalakeluarga', 'id_kk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('air');
    }

    public function down()
    {
        $this->forge->dropTable('air');
    }
}
