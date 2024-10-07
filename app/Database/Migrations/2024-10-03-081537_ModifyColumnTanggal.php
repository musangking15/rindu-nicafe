<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnTanggal extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tbl_transaksi', [
            'tanggal' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
