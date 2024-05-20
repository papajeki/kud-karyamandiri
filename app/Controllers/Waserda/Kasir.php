<?php

namespace App\Controllers\Waserda;

use App\Controllers\BaseController;

//require_once '../BaseController.php';

class Kasir extends BaseController
{
    public function index()
    {
        echo view("waserda/kasir");
    }
    
    public function kasir()
    {
        echo view("waserda/transaksi");
    }
    public function produk()
    {
        echo view("waserda/produk");
    }
    public function data_penjualan()
    {
        echo view("waserda/data_penjualan");
    }
}