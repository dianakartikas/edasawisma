<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Makanan extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_makanan'         => [
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
            'makanan_pokok' => [
                'type'          => 'ENUM',
                'constraint'    => ['Nasi','Kentang','Ubi','Sagu','Singkong', 'Jagung', 'Lainnya'],
                'default'       => 'Nasi',
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
        $this->forge->addKey('id_makanan', TRUE);
        $this->forge->addForeignKey('id_kk', 'kepalakeluarga', 'id_kk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('makanan');
    }

    public function down()
    {
        $this->forge->dropTable('makanan');
    }
}
