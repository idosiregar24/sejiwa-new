<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAffirmationsTable extends Migration
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
        'content' => [
            'type' => 'TEXT'
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('affirmations');
    }

    public function down()
    {
        $this->forge->dropTable('affirmations');
    }
}
