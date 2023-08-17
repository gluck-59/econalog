<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_level' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 1,
                'comment'    => '1: user, 2: admin',
            ],
            'is_active' => [
                'type' => 'INT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => '0: not active, 1: active',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
