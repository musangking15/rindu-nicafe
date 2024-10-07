<?php

namespace App\Database\Seeds;

use App\Models\KategoriModel;
use CodeIgniter\Database\Seeder;

class Category extends Seeder
{
    protected $category;

    public function __construct()
    {
        $this->category = new KategoriModel();
    }

    public function run()
    {
        $data = [
            [
                'kategori' => 'coffee'
            ],
            [
                'kategori' => 'noncoffee'
            ],
            [
                'kategori' => 'snacks'
            ],
            [
                'kategori' => 'maincourse'
            ],
            [
                'kategori' => 'paket'
            ]
        ];

        $this->category->insertBatch($data);
    }
}
