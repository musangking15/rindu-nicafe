<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $user = $this->request->getVar();

        if (empty($user['username']) || empty($user['password'])) {
            session()->setFlashdata('jenis', 'warning');
            session()->setFlashdata('pesan1', 'Gagal Login!');
            session()->setFlashdata('pesan2', 'Username dan Password tidak boleh kosong');
            return redirect()->back();
        }

        $admin = $this->userModel->where('username', $user['username'])->first();

        if ($admin) {
            if (password_verify($user['password'], $admin['password'])) {
                $params['username'] = $admin['username'];
                session()->set($params);
                return redirect()->route('transaksi');
            } else {
                session()->setFlashdata('jenis', 'warning');
                session()->setFlashdata('pesan1', 'Gagal Login!');
                session()->setFlashdata('pesan2', 'Password salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('jenis', 'warning');
            session()->setFlashdata('pesan1', 'Gagal Login!');
            session()->setFlashdata('pesan2', 'Username salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
