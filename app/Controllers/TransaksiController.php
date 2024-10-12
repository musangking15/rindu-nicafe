<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        $transaksi = $this->transaksiModel->where('is_ready', '1')->findAll();

        foreach ($transaksi as &$value) {
            $value['pesanan'] = json_decode($value['pesanan'], true);
        }

        return view('admin/transaksi', ['transaksi' => $transaksi]);
    }

    public function ready($id)
    {

        $data = [
            'is_ready' => 2
        ];

        $this->transaksiModel->update($id, $data);

        return redirect()->back();
    }

    public function riwayat()
    {
        $filterDate = $this->request->getVar('date');
        $tahun = $this->request->getVar('year') ?? date('Y');

        if (!$filterDate) {
            $filterDate = date('Y-m-d');
        }

        $pendapatan = $this->transaksiModel->getYear($tahun);

        $riwayat = $this->transaksiModel
            ->where('is_ready', 2)
            ->Where('tanggal', $filterDate)
            ->find();


        $data = [
            'riwayat'    => $riwayat,
            'pendapatan' => $pendapatan,
            'tahun'      => $tahun
        ];

        return view('admin/riwayat', $data);
    }
}
