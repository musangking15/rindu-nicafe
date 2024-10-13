<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnPost extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_menu', [
            'post' => [
                'type' => 'ENUM',
                'constraint' => ['publish', 'draft'],
                'default'    => 'publish',
                'after' => 'gambar',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_menu', 'post');
    }
}
