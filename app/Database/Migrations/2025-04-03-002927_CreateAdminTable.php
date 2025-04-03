<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        // Create the admin table
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
            'username'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_admin'    => [
                'type'       => 'BOOLEAN',
                'default'    => true,  // Admin user by default
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
        $this->forge->createTable('admins');

        $this->forge->addUniqueKey('email'); // Adds unique constraint to the email column

    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('admins');
    }
}
