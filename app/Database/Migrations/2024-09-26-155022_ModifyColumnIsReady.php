<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnIsReady extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tbl_transaksi', [
            'is_ready' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
