<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCiSessionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => false,
            ],
            'timestamp' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => false,
            ],
            'data' => [
                'type' => 'blob',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->addKey('timestamp'); // Index

        $this->forge->createTable('ci_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions');
    }
}
