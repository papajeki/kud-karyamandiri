<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view("welcome_message");
    }
    public function main()
    {
        echo view("select_role");
    }
}
