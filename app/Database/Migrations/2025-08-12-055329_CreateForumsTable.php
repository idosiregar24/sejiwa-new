<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateForumsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true
        ],
        'title' => [
            'type' => 'VARCHAR',
            'constraint' => 200
        ],
        'content' => [
            'type' => 'TEXT'
        ],
        'user_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('forums');
    }

    public function down()
    {
        $this->forge->dropTable('forums');
    }
}
