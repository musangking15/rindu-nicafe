<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\MenuModel;
use CodeIgniter\HTTP\ResponseInterface;

class MenuController extends BaseController
{
    protected $menuModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        // $menu = $this->menuModel->findAll();
        // $menu = $this->menuModel->getAll();
        $menu = $this->menuModel->orderBy('id_kategori', 'desc')->getAll();

        $data['menu'] = $menu;

        // dd($data);

        return view('admin/menu/data_menu', $data);
    }

    public function tambah()
    {
        $kategori = $this->kategoriModel->findAll();
        $data['kategori'] = $kategori;

        return view('admin/menu/tambah_menu', $data);
    }

    public function input()
    {
        $validationRules = [
            'nama_makanan' => 'required',
            'deskripsi'    => 'required',
            'harga'        => 'required|numeric',
            'id_kategori'  => 'required',
            'post'         => 'required',
            'gambar'       => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->route('tambah_menu');
        }

        $nama_makanan = $this->request->getVar('nama_makanan');
        $deskripsi = $this->request->getVar('deskripsi');
        $harga = $this->request->getVar('harga');
        $post = $this->request->getVar('post');
        $id_kategori = intval($this->request->getVar('id_kategori'));
        $gambar = $this->request->getFile('gambar');

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $newName = $gambar->getRandomName();
            $gambar->move('gambar', $newName);
            $gambarPath = $newName;
        }

        $data = [
            'nama_makanan' => $nama_makanan,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'post' => $post,
            'kategori' => $id_kategori,
            'gambar' => $gambarPath,
        ];


        $input = $this->menuModel->insert($data);

        if ($input) {
            return redirect()->route('data_menu')->with('success', 'Berhasil menambahkan menu!');
        } else {
            return redirect()->route('data_menu')->with('failed', 'Gagal menambahkan menu!');
        }
    }

    public function edit($id)
    {
        $menu = $this->menuModel->find($id);
        $kategori = $this->kategoriModel->findAll();

        $data = [
            'menu' => $menu,
            'kategori' => $kategori,
        ];

        // dd($data);

        return view('admin/menu/edit_menu', $data);
    }

    public function update($id)
    {

        $menu = $this->menuModel->find($id);

        if (!$menu) {
            return redirect()->route('data_menu');
        }

        $nama_makanan = $this->request->getVar('nama_makanan');
        $deskripsi = $this->request->getVar('deskripsi');
        $harga = $this->request->getVar('harga');
        $post = $this->request->getVar('post');
        $id_kategori = intval($this->request->getVar('id_kategori'));

        $menuData = [
            'nama_makanan' => $nama_makanan,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'post' => $post,
            'id_kategori' => $id_kategori,
        ];

        if ($_FILES['gambar']['name'] !== '') {
            $validationRules['gambar'] = 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if ($_FILES['gambar']['name'] !== '') {
            $gambar = $this->request->getFile('gambar');
            unlink('gambar/' . $menu['gambar']);
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $newName = $gambar->getRandomName();
                $gambar->move('gambar', $newName);
                $menuData['gambar'] = $newName;
            }
        } else {
            $menuData['gambar'] = $menu['gambar'];
        }

        $update = $this->menuModel->update($id, $menuData);

        // dd($menuData);


        if ($update) {
            return redirect()->route('data_menu')->with('success', 'Berhasil mengedit menu!');
        } else {
            return redirect()->route('data_menu')->with('failed', 'Gagal mengedit menu!');
        }
    }

    public function delete($id)
    {
        $menu = $this->menuModel->find($id);

        unlink('gambar/' . $menu['gambar']);

        if ($menu) {
            $this->menuModel->delete($id);
            return redirect()->route('data_menu')->with('success', 'Berhasil menghapus menu!');
        } else {
            return redirect()->route('data_menu')->with('failed', 'Gagal menghapus menu!');
        }
    }
}
