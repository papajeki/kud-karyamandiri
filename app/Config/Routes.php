<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/index', 'Home::main');
$routes->get('/dashboard_admin', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/testdatabaseconnection', 'TestDatabaseConnection::index');

//login auth
$routes->post('/login/auth', 'Login::process');
//  Group admin
// $routes->group('admin', function($routes){
//     $routes->get('users','Admin\Users::index');
// });

// grup routes Roles Admin
$routes->group('admin',function($routes){
    //$routes->get('/', 'Admin\Admin::index');
    $routes->get('users', 'Admin\Users::index');
    // route alamat untuk simpan data user
    $routes->post('simpan', 'Admin\Users::simpan');
    //untuk masuk ke halaman create user
    $routes->get('create_user', 'Admin\Users::create_user');
    $routes->post('delete/(:num)', 'Admin\Users::delete/$1');
    $routes->get('harga_tbs', 'Admin\Admin::tabel_harga_sawit');
    $routes->get('input_harga_sawit', 'Admin\Admin::input_harga_sawit');
    // $routes->post('input_harga_sawit', 'Admin\Admin::input_harga_sawit');
});

$routes->group('waserda',function($routes){
// kud-karyamandiri/waserda/
    $routes->get('/','Waserda\Kasir::index');
    $routes->get('kasir','Waserda\Kasir::kasir');
    $routes->get('produk','Waserda\Kasir::produk');
    $routes->get('data_penjualan','Waserda\Kasir::data_penjualan');
});