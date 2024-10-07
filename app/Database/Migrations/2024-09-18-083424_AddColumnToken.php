<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnToken extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_transaksi', [
            'token' => [
                'type' => 'TEXT',
                'null' => true,  // Bisa null
                'after' => 'order_id',  // Letakkan setelah field yang sudah ada
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_transaksi', 'token');
    }
}
