<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAffirmationStatusTable extends Migration
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
        'user_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true
        ],
        'affirmation_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true
        ],
        'status' => [
            'type' => 'ENUM',
            'constraint' => ['seen', 'unseen'],
            'default' => 'unseen'
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('affirmation_id', 'affirmations', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('user_affirmation_status');
    }

    public function down()
    {
        $this->forge->dropTable('user_affirmation_status');
    }
}
