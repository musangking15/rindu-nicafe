<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblMenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_menu' => [
                'type'           => 'INT',
                'constraint' => '11',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_makanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'kategori' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => '11'
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);
        $this->forge->addKey('id_menu', true);
        $this->forge->addForeignKey('kategori', 'tbl_kategori', 'id_kategori');
        $this->forge->createTable('tbl_menu');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_menu');
    }
}
