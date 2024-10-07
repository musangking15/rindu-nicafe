<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnIsReady extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_transaksi', [
            'is_ready' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,  // Bisa null
                'after' => 'status', // Letakkan setelah field yang sudah ada
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_transaksi', 'is_ready');
    }
}
