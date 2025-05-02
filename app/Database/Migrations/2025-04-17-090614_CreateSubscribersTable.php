<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 191, 'unique' => true],
            'created_at'  => ['type' => 'DATETIME'],
            'updated_at'  => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('subscribers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('subscribers', true);
    }
}
