<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserUnlockedCoursesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11],
            'course_id'   => ['type' => 'INT', 'constraint' => 11],
            'unlocked_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
    
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_unlocked_courses');
    }
    
    public function down()
    {
        $this->forge->dropTable('user_unlocked_courses');
    }
}
