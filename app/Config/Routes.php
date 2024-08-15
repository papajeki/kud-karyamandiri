<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//index
 $routes->get('/index', 'Home::main',['filter' => 'auth']);
//$routes->get('/dashboard_admin', 'Home::index',['filter' => 'auth']);

$routes->get('/testdatabaseconnection', 'TestDatabaseConnection::index');
$routes->add('download/(:any)', 'FileController::download/$1');
$routes->get('export-excel', 'Waserda\Penjualan::exportExcel');



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
$routes->group('waserda',['filter' => 'auth'],function($routes){
// kud-karyamandiri/waserda/
    $routes->get('/','Waserda\Kasir::index');
    //waserda kasir (transaksi)
    $routes->add('kasir','Waserda\Kasir::kasir');
    $routes->add('kasir/selesaitransaksi', 'Waserda\Kasir::selesaitransaksi');
    $routes->get('kasir/redirect_to_receipt/(:num)', 'Waserda\Kasir::redirect_to_receipt/$1');
    $routes->get('kasir/receipt/(:num)' , 'Waserda\Kasir::receipt/$1');
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
    $routes->add('report', 'Waserda\Penjualan::index');
    $routes->get('labapenjualan', 'Waserda\Penjualan::laba');
    $routes->get('credits', 'Waserda\Credits::credits');
    $routes->get('credits/credits_detail/(:num)', 'Waserda\Credits::detail/$1');
    $routes->post('pelunasan/(:num)', 'Waserda\Credits::pelunasan/$1');

});

$routes->group('ksp',function($routes){
    $routes->get('/', 'Ksp\KSP::index',['filter' => 'auth']);
    //keanggotaan
    $routes->get('anggota', 'Ksp\KSP::anggota');
    $routes->get('anggotaumum', 'Ksp\KSP::umum');
    $routes->add('tambahanggota', 'Ksp\KSP::tambahanggota');
    $routes->post('edit_anggota/(:num)', 'Ksp\KSP::edit_anggota/$1');
    //simpanan
    $routes->get('tabungan_kapling', 'Ksp\Simpan::simpanan_kapling');
    $routes->get('tabungan_umum', 'Ksp\Simpan::simpanan_umum');
    $routes->add('bukutabungan', 'Ksp\Simpan::tambah_tabungan');
    $routes->add('tabungan_detail/(:num)', 'Ksp\Simpan::tabungan_detail/$1');
    $routes->add('simpan_transaksi/(:num)', 'Ksp\Simpan::simpan_transaksi/$1');
    $routes->add('tarik_transaksi/(:num)', 'Ksp\Simpan::tarik_transaksi/$1');
    //pinjaman
    $routes->get('pinjaman','Ksp\Pinjaman::daftar_peminjam');
    $routes->add('pinjaman_detail/(:num)', 'Ksp\Pinjaman::pinjaman_detail/$1');
    $routes->add('pembayaran/(:num)', 'Ksp\Pinjaman::pembayaran/$1');
    $routes->add('tambah_pinjaman', 'Ksp\Pinjaman::tambah_pinjaman');
    //pengaturan
    $routes->get('pengaturan', 'Ksp\Pinjaman::pengaturan');
    $routes->add('pengaturan-nominal', 'Ksp\Pengaturan::nominal');
    $routes->add('pengaturan-tempo', 'Ksp\Pengaturan::tempo');
    $routes->add('pengaturan-kelompok', 'Ksp\Pengaturan::kelompok');
    $routes->post('edit_nominal', 'Ksp\Pengaturan::kelompok');
    $routes->post('tambah_nominal', 'Ksp\Pengaturan::tambah_nominal');
    $routes->add('edit_nominal', 'Ksp\Pengaturan::edit_nominal');
    $routes->add('hapus_nominal/(:num)', 'Ksp\Pengaturan::hapus_nominal/$1');
    $routes->post('tambah_tempo', 'Ksp\Pengaturan::tambah_tempo');
    $routes->post('edit_tempo', 'Ksp\Pengaturan::edit_tempo');
    $routes->post('hapus_tempo/(:num)', 'Ksp\Pengaturan::hapus_tempo/$1');
    $routes->post('tambah_kelompok', 'Ksp\Pengaturan::tambah_kelompok');
    $routes->post('edit_kelompok', 'Ksp\Pengaturan::edit_kelompok');
    $routes->post('hapus_kelompok/(:num)', 'Ksp\Pengaturan::hapus_kelompok/$1');
});