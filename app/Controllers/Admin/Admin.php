<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// require_once '../BaseController.php';

class Admin extends BaseController
{
    public function index()
    {
        echo view("admin/admin");
    }

    public function tabel_harga_sawit()
    {
        echo view("admin/harga_tbs");
    }

    public function input_harga_sawit()
    {
        echo view("admin/input_harga_sawit");
    }

    // public function users()
    // {
    //     echo view("admin/users");
    // }
    
}