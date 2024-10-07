<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnTanggalAgain extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tbl_transaksi', [
            'tanggal' => [
                'type' => 'date',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
