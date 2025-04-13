<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleTuUsers extends Migration
{
    public function up()
    {
        $fields = [
            'role' => ['type' => 'INT'],
            'fio' => ['type' => 'TEXT'],
        ];
        $this->forge->addColumn('users', $fields);
// Executes: ALTER TABLE `table_name` ADD `preferences` TEXT
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role'); // to drop one single column
        $this->forge->dropColumn('users', 'fio');

    }
}
