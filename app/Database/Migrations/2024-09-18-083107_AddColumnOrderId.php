<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOrderId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_transaksi', [
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,  // Bisa null
                'after' => 'id_transaksi',  // Letakkan setelah field yang sudah ada
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_transaksi', 'order_id');
    }
}
