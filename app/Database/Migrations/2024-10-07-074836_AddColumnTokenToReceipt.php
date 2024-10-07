<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnTokenToReceipt extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tbl_transaksi', [
            'token' => [
                'name' => 'receipt',
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
