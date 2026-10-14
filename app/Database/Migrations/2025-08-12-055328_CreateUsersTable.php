<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true, // Boleh null kalau daftar pakai no HP
                'unique'     => true
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true, // Boleh null kalau daftar pakai email
                'unique'     => true
            ],
            'date_of_birth' => [
                'type'       => 'DATE',
                'null'       => false
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'admin'],
                'default'    => 'user'
            ],
            'is_verified' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0
            ],
            'created_at' => [
            'type' => 'DATETIME',
            'null' => true
            ],
            'updated_at' => [
            'type' => 'DATETIME',
            'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
