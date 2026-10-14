<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyTypeEnumInContents extends Migration
{
    public function up()
    {
        $fields = [
            'type' => [
                'name'       => 'type',
                'type'       => 'ENUM',
                'constraint' => ['Artikel','Infografis','Video','Audio'],
                'default'    => 'Artikel',
            ],
        ];
        $this->forge->modifyColumn('contents', $fields);
    }

    public function down()
    {
        $fields = [
            'type' => [
                'name'       => 'type',
                'type'       => 'ENUM',
                'constraint' => ['Artikel','Video','Podcast'],
                'default'    => 'Artikel',
            ],
        ];
        $this->forge->modifyColumn('contents', $fields);
    }
}