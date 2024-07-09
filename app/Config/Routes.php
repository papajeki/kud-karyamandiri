<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//index
 $routes->get('/index', 'Home::main',['filter' => 'auth']);
//$routes->get('/dashboard_admin', 'Home::index',['filter' => 'auth']);

$routes->get('/testdatabaseconnection', 'TestDatabaseConnection::index');


//login
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::process');
$routes->post('logout', 'Login::logout');

// grup routes Roles Admin
$routes->group('admin',['filter' => 'auth'],function($routes){
    $routes->get('/', 'Admin\Admin::index');
    $routes->get('users', 'Admin\Users::index');
    // route alamat untuk simpan data user
    $routes->post('simpan', 'Admin\Users::simpan');
    //untuk masuk ke halaman create user
    $routes->get('create_user', 'Admin\Users::create_user');
    $routes->post('delete/(:num)', 'Admin\Users::delete/$1');
    //edit & update user
    $routes->add('edit_user/(:num)','Admin\Users::edit_user/$1');
    $routes->post('update/(:num)','Admin\Users::update/$1');
    //harga sawit
    $routes->get('harga_tbs', 'Admin\Admin::tabel_harga_sawit');
    $routes->add('input_harga_sawit', 'Admin\Admin::input_harga_sawit');
    // $routes->post('input_harga_sawit', 'Admin\Admin::input_harga_sawit');
});
//GROUP ROUTE WASERDA
$routes->group('waserda',function($routes){
// kud-karyamandiri/waserda/
    $routes->get('/','Waserda\Kasir::index');
    $routes->add('kasir','Waserda\Kasir::kasir');
    $routes->post('kasir/completeTransaction', 'Waserda\Kasir::completeTransaction');

    //produk waserda
    $routes->get('barang','Waserda\Barang::produk');
    $routes->add('create_barang','Waserda\Barang::create_barang');
    $routes->post('update_barang/(:num)', 'Waserda\Barang::update_barang/$1');
    //$routes->add('edit_produk/(:num)','Waserda\Barang::edit_produk/$1');
    $routes->post('edit_harga_produk/(:num)', 'Waserda\Barang::update_harga_barang/$1');
    //stok barang
    $routes->add('stok_barang/(:num)','Waserda\Barang::stok_barang/$1');
    $routes->post('restok','Waserda\Barang::restok');
    $routes->add('edit_stok/(:num)','Waserda\Barang::edit_stok/$1');
    $routes->post('update_stok/(:num)', 'Waserda\Barang::update_stok/$1');
    
    //riwayat transaksi
    $routes->get('data_penjualan','Waserda\Kasir::data_penjualan');
});