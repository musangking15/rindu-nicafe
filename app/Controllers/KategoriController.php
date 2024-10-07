<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'kategori' => $kategori
        ];

        return view('admin/kategori/data_kategori', $data);
    }

    public function tambah()
    {
        return view('admin/kategori/tambah_kategori');
    }

    public function input()
    {
        $nama_kategori = $this->request->getVar('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori
        ];

        $input = $this->kategoriModel->insert($data);

        if ($input) {
            return redirect()->route('data_kategori')->with('success', 'Berhasil menambahkan kategori!');
        } else {

            return redirect()->route('data_kategori')->with('failed', 'Gagal menambahkan kategori!');
        }
    }

    public function edit($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            throw new PageNotFoundException('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'kategori' => $kategori
        ];

        return view('admin/kategori/edit_kategori', $data);
    }

    public function update($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->route('data_kategori');
        }

        $nama_kategori = $this->request->getVar('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori
        ];

        $update = $this->kategoriModel->update($id, $data);

        if ($update) {
            return redirect()->route('data_kategori')->with('success', 'Berhasil mengedit kategori!');
        } else {

            return redirect()->route('data_kategori')->with('failed', 'Gagal mengedit kategori!');
        }
    }

    public function delete($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if ($kategori) {
            $this->kategoriModel->delete($id);
            return redirect()->route('data_kategori')->with('success', 'Berhasil menghapus kategori!');
        } else {
            return redirect()->route('data_kategori')->with('failed', 'Gagal menghapus kategori!');
        }
    }
}
