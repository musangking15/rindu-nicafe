<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class TblPesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'INT',
                'constraint' => '11',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'total' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'pesanan' => [
                'type' => 'TEXT',
            ],
            'tanggal' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ]
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->createTable('tbl_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_transaksi');
    }
}
