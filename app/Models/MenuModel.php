<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'tbl_menu';
    protected $primaryKey       = 'id_menu';
    protected $allowedFields    = ['nama_makanan', 'deskripsi', 'kategori', 'harga', 'gambar', 'post'];


    public function getAll()
    {
        return $this->db->table($this->table)
            ->select('tbl_menu.*, tbl_kategori.nama_kategori AS nama_kategori')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_menu.kategori')
            ->get()
            ->getResultArray();
    }

    public function getCategory($category)
    {
        return $this->db->table($this->table)
            ->select('tbl_menu.*, tbl_kategori.nama_kategori AS nama_kategori')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_menu.kategori')
            ->where('nama_kategori', $category)
            ->where('post', 'publish')
            ->get()
            ->getResultArray();
    }
}
