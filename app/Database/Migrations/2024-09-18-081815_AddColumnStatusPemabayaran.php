<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnStatusPemabayaran extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_transaksi', [
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true,  // Bisa null
                'after' => 'pesanan',  // Letakkan setelah field yang sudah ada
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_transaksi', 'status');
    }
}
