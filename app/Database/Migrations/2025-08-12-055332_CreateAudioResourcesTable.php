<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAudioResourcesTable extends Migration
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
        'file_path' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'description' => [
            'type' => 'TEXT',
            'null' => true
        ],
        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('audio_resources');
    }

    public function down()
    {
        $this->forge->dropTable('audio_resources');
    }
}
