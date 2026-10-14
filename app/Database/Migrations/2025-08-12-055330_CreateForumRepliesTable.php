<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateForumRepliesTable extends Migration
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
        'forum_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true
        ],
        'user_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true
        ],
        'reply_content' => [
            'type' => 'TEXT'
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('forum_id', 'forums', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('forum_replies');
    }

    public function down()
    {
        $this->forge->dropTable('forum_replies');
    }
}
