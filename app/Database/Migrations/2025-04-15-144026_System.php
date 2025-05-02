<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class System extends Migration
{
    public function up()
    {
       // Create the system table
       $this->forge->addField([
        'id'          => [
            'type'           => 'INT',
            'unsigned'      => true,
            'auto_increment' => true,
        ],
        'email'       => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
        'name'    => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
        ],
        'phone' => [
            'type' => 'INT',
            'constraint' => '10',
        ],
        'created_at'  => [
            'type' => 'DATETIME',
        ],
        'updated_at'  => [
            'type' => 'DATETIME',
        ],
    ]);

    // Add primary key
    $this->forge->addPrimaryKey('id');

    // Create table
    $this->forge->createTable(table: 'system');

    $this->forge->addUniqueKey('email'); // Adds unique constraint to the email column
    }

    public function down()
    {
        $this->forge->dropTable('system', true); // `true` forces drop if exists
    }
}
