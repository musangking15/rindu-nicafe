<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = ['nama_customer', 'pesanan', 'total', 'status', 'order_id', 'token', 'is_ready', 'tanggal'];
}
