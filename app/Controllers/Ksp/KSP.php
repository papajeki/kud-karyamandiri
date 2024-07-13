<?php

namespace App\Controllers\Ksp;

use App\Controllers\BaseController;

class KSP extends BaseController
{ 
    public function __construct()
    {
        if (session()->get('role') !== "ksp" && session()->get('role') !== "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        echo view('ksp/dashboard');
    }
}
