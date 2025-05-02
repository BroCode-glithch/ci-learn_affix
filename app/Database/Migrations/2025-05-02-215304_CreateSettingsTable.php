<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
      // Create 'settings' table
      $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'class' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'property' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
        ],
        'value' => [
            'type' => 'TEXT',
        ],
        'type' => [
            'type' => 'VARCHAR',
            'constraint' => 50,
        ],
        'context' => [
            'type' => 'VARCHAR',
            'constraint' => 100,
            'null' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ]
    ]);

    // Set the primary key for the 'settings' table
    $this->forge->addKey('id', true);

    // Create the 'settings' table
    $this->forge->createTable('settings');
    }

    public function down()
    {
        // Drop the 'settings' table if it exists
        $this->forge->dropTable('settings');
    }
}
