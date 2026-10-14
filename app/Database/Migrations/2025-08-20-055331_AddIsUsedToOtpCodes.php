<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsUsedToOtpCodes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('otp_codes', [
            'is_used' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
                'null'       => false,
                'after'      => 'expires_at', // letakkan setelah kolom expires_at
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('otp_codes', 'is_used');
    }
}
