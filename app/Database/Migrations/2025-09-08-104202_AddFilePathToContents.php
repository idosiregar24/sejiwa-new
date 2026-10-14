<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFilePathToContents extends Migration
{
    public function up()
    {
        $fields = [
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'thumbnail',
                'null'       => true,
            ],
        ];
        $this->forge->addColumn('contents', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('contents', 'file_path');
    }
}