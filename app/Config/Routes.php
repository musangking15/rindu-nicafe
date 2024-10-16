<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login', ['as' => 'login']);
$routes->get('/logout', 'Home::logout', ['as' => 'logout']);
$routes->get('/cek', 'Home::cek');
$routes->get('/destroy', 'Home::destroy');
$routes->get('/delete/(:any)', 'Home::delete/$1', ['as' => 'delete']);
$routes->set404Override(function () {
    return view('errors/error_page');
});



$routes->group('admin', static function ($routes) {
    $routes->addRedirect('/', 'admin/transaksi');
    $routes->get('transaksi', 'TransaksiController::index', ['as' => 'transaksi']);
    $routes->post('transaksi/ready/(:any)', 'TransaksiController::ready/$1', ['as' => 'ready']);
    $routes->group('data-menu', static function ($routes) {
        $routes->get('/', 'MenuController::index', ['as' => 'data_menu']);
        $routes->get('tambah', 'MenuController::tambah', ['as' => 'tambah_menu']);
        $routes->post('input', 'MenuController::input', ['as' => 'input_menu']);
        $routes->get('edit/(:any)', 'MenuController::edit/$1', ['as' => 'edit_menu']);
        $routes->post('update/(:any)', 'MenuController::update/$1', ['as' => 'update_menu']);
        $routes->delete('hapus/(:any)', 'MenuController::delete/$1', ['as' => 'delete_menu']);
    });
    $routes->group('data-kategori', static function ($routes) {
        $routes->get('/', 'KategoriController::index', ['as' => 'data_kategori']);
        $routes->get('tambah', 'KategoriController::tambah', ['as' => 'tambah_kategori']);
        $routes->post('input', 'KategoriController::input', ['as' => 'input_kategori']);
        $routes->get('edit/(:any)', 'KategoriController::edit/$1', ['as' => 'edit_kategori']);
        $routes->post('update/(:any)', 'KategoriController::update/$1', ['as' => 'update_kategori']);
        $routes->delete('hapus/(:any)', 'KategoriController::delete/$1', ['as' => 'delete_kategori']);
    });
    $routes->get('riwayat', 'TransaksiController::riwayat', ['as' => 'riwayat']);
});
