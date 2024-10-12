<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = ['nama_customer', 'pesanan', 'total', 'status', 'order_id', 'receipt', 'is_ready', 'tanggal'];

    public function getYear($year)
    {
        $result = $this->select('MONTH(tanggal) as bulan, SUM(total) as total_pendapatan')
            ->where('YEAR(tanggal)', $year)
            ->where('is_ready', 2)
            ->groupBy('MONTH(tanggal)')
            ->orderBy('MONTH(tanggal)', 'ASC')
            ->findAll();

        $pendapatanPerBulan = array_fill(1, 12, 0);

        foreach ($result as $row) {
            $pendapatanPerBulan[(int)$row['bulan']] = (float)$row['total_pendapatan'];
        }

        return $pendapatanPerBulan;
    }
}
