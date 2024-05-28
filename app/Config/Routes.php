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
$routes->get('logout', 'Login::logout');

// grup routes Roles Admin
$routes->group('admin',['filter' => 'auth'],function($routes){
    $routes->get('/', 'Admin\Admin::index');
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