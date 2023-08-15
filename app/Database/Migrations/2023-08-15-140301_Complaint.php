<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Complaint extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'complaint_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pelapor' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'default' => 'Anonim',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'default' => '-',
            ],
            'detail' => [
                'type' => 'TEXT',
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => '0',
                'comment' => '0 = baru, 1 = diproses, 2 = selesai',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('complaint_id', true);
        $this->forge->createTable('complaints');
    }

    public function down()
    {
        $this->forge->dropTable('complaints');
    }
}
