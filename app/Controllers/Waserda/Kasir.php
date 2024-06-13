<?php

namespace App\Controllers\Waserda;

use App\Controllers\BaseController;
use App\Models\BarangModel;

//require_once '../BaseController.php';

class Kasir extends BaseController
{
    public function __construct()
    {
        
        if (session()->get('role') !== "kasir" && session()->get('role') !=="admin") {
            echo 'Access denied';
            exit;
            
        }
    }
    public function index()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;
        echo view("waserda/kasir",$data);
    }
    
    public function kasir()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;
        echo view("waserda/transaksi",$data);
    }

    //controller produk/barang
    public function edit_produk($id_barang)
    {
        $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;

        $model = new BarangModel;
        $data['barang'] = $model->where('id_barang',$id_barang)->first();

        return view('waserda/edit_produk',$data);
    }

    //controller penjualan
    public function data_penjualan()
    { $sess = session();
        $surename = $sess->get('surename');
        $data['surename'] = $surename;
        echo view("waserda/data_penjualan",$data);
    }
}