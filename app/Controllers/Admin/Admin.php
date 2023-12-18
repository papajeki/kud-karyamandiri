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

    public function users()
    {
        echo view("admin/users");
    }
}