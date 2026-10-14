<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOtpCodesTable extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true
            ],
            'otp_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 6
            ],
            'channel' => [
                'type'       => 'ENUM',
                'constraint' => ['email', 'phone']
            ],
            'expires_at' => [
                'type' => 'DATETIME'
            ],
            'created_at' => [
            'type' => 'DATETIME',
            'null' => true
],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('otp_codes');
    }

    public function down()
    {
        $this->forge->dropTable('otp_codes');
    }
}
