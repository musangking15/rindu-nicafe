<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $menuModel;
    protected $userModel;
    protected $transaksiModel;
    protected $kategoriModel;
    protected $cart;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->userModel = new UserModel();
        $this->transaksiModel = new TransaksiModel();
        $this->kategoriModel = new KategoriModel();
        $this->cart = \Config\Services::cart();
    }

    public function index()
    {
        // if (!session()->has('hasSeenSplash')) {
        //     session()->set('hasSeenSplash', true);
        //     return redirect()->to('/splash'); // Redirect ke halaman splash jika belum pernah dilihat
        // }

        // if (session()->has('hasSeenSplash')) {
        //     session()->remove('hasSeenSplash');
        // }

        if (session()->has('username')) {
            return redirect()->route('transaksi');
        }

        // if (session()->has('token')) {
        //     $data['token'] = session()->getFlashdata('token');
        // }

        $kategori = $this->kategoriModel->findAll();

        $category = $this->request->getVar('category');

        if ($category) {
            $items = $this->menuModel->getCategory($category);
        } else {
            $items = $this->menuModel->where('post', 'publish')->findAll();
        }

        $data = [
            'items' => $items,
            'selectedCategory' => $category,
            'carts' => $this->cart->contents(),
            'keranjang' => $this->cart,
            'kategori' => $kategori
        ];

        // dd($kategori);


        return view('landing_page', $data);
    }


    // public function cek()
    // {
    //     dd($this->cart->contents());
    // }

    public function destroy()
    {
        return $this->cart->destroy();
    }

    public function add()
    {
        $item = $this->request->getVar();

        $this->cart->insert(array(
            'id'      => $item['id'],
            'qty'     => 1,
            'price'   => $item['price'],
            'name'    => $item['name'],
        ));

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->cart->remove($id);

        return redirect()->back();
    }

    public function transaksi()
    {

        $customer = $this->request->getVar('customer');

        $validationRule = [
            'customer' => 'required',
            'receipt' => 'uploaded[receipt]|mime_in[receipt,image/jpg,image/jpeg,image/png]|is_image[receipt]'
            // 'receipt' => [
            //     'rules' => 'uploaded[receipt]|mime_in[receipt,image/jpg,image/jpeg,image/png]|is_image[receipt]',
            //     'errors' => [
            //         'uploaded' => 'Bukti pembayaran harus diunggah',
            //         'mime_in' => 'File harus berupa gambar JPG/PNG',
            //         'max_size' => 'Ukuran maksimal gambar 2MB'
            //     ]
            // ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back();
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        // Upload file
        $receiptFile = $this->request->getFile('receipt');
        if ($receiptFile->isValid() && !$receiptFile->hasMoved()) {
            $newName = $customer . date('Y-m-d');
            $receiptFile->move('bukti', $newName);
        }

        // Data untuk disimpan
        $data = [
            'nama_customer' => $customer,
            'pesanan' => json_encode($this->cart->contents()),
            'total' => $this->cart->total(),
            'status' => 'paid',
            'is_ready' => 1,
            'order_id' => rand(),
            'receipt' => $newName,
            'tanggal' => date('Y-m-d')
            // 'pesanan' => serialize($this->cart->contents()),  // Serialisasi isi keranjang
        ];

        // Simpan ke database
        $transaksi =  $this->transaksiModel->insert($data);

        if ($transaksi) {
            // Kosongkan keranjang
            $this->destroy();

            session()->setFlashdata('jenis', 'success');
            session()->setFlashdata('pesan1', 'Success!');
            session()->setFlashdata('pesan2', 'Terima kasih, pesanan Anda sedang diproses');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('jenis', 'error');
            session()->setFlashdata('pesan1', 'Failed!');
            session()->setFlashdata('pesan2', 'Maaf, pesanan gagal');
            return redirect()->to('/');
        }
    }
}

    // public function checkout()
    // {
    //     // Set your Midtrans server key
    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-6FsHwbSw6fFHFVLfrl4dbluD';
    //     \Midtrans\Config::$isProduction = false;
    //     \Midtrans\Config::$isSanitized = true;
    //     \Midtrans\Config::$is3ds = true;

    //     $input = $this->request->getJSON();
    //     $customerName = $input->customer;

    //     $grossAmount = $this->cart->total();

    //     $cartItem = $this->cart->contents();

    //     if (empty($customerName) || $grossAmount <= 0) {
    //         return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama customer atau total transaksi tidak valid']);
    //     }

    //     $items = [];

    //     foreach ($cartItem as $item) {
    //         $items[] = [
    //             'id'       => $item['id'],
    //             'price'    => $item['price'],
    //             'quantity' => $item['qty'],
    //             'name'     => $item['name']
    //         ];
    //     };

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' =>   rand(),
    //             'gross_amount' => $grossAmount,
    //         ),
    //         'item_details' => $items,
    //         'customer_details' => array(
    //             'first_name' => $customerName,
    //         ),
    //     );


    //     try {
    //         $snapToken = \Midtrans\Snap::getSnapToken($params);

    //         session()->set('order_id', $params['transaction_details']['order_id']);
    //         session()->set('snaptoken', $snapToken);
    //         session()->set('customer', $customerName);

    //         return $this->response->setJSON(['token' => $snapToken, 'params' => $params]);
    //     } catch (\Exception $e) {
    //         return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
    //     }
    // }

    // public function success()
    // {
    //     $cartItem = $this->cart->contents();
    //     $grossAmount = $this->cart->total();

    //     $orderId = session()->get('order_id');
    //     $snaptoken = session()->get('snaptoken');
    //     $customer = session()->get('customer');

    //     $data = [
    //         'nama_customer' => $customer,
    //         'pesanan' => json_encode($cartItem),
    //         'total' => $grossAmount,
    //         'status' => 'paid',
    //         'order_id' => $orderId,
    //         'token' => $snaptoken,
    //         'is_ready' => 1,
    //         'tanggal' => date('Y-m-d')
    //     ];

    //     $this->transaksiModel->insert($data);

    //     $this->cart->destroy();

    //     session()->remove(['order_id', 'snaptoken', 'customer']);

    //     return redirect()->to('/');
    // }
