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
        $filter = $this->request->getVar('date');

        if (!$filter) {
            $filter = date('Y-m-d');
        }



        $riwayat = $this->transaksiModel
            ->where('is_ready', 2)
            ->Where('tanggal', $filter)
            ->find();

        $data['riwayat'] = $riwayat;

        return view('admin/riwayat', $data);
    }
}
