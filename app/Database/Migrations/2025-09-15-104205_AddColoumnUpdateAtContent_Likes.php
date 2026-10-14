<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtToOtpCodes extends Migration
{
    public function up()
    {
        $fields = [
            'updated_at_likes' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'after'   => 'created_at', 
            ]
        ];

        $this->forge->addColumn('content_likes', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('content_likes', 'updated_at_likes');
    }
}
