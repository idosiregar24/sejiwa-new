<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsVerifiedAndPurposeToOtpCodes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('otp_codes', [
            'is_verified' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'after' => 'otp_code', // opsional: letakkan setelah kolom tertentu
            ],
            'purpose' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'after' => 'is_verified',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('otp_codes', ['is_verified', 'purpose']);
    }
}
