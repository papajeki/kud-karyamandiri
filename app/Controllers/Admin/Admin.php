<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// require_once '../BaseController.php';

class Admin extends BaseController
{
    public function __construct()
    {
        
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
            
        }
    }
    public function index()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surname = $sess->get('surname');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surname'] = $surname;
        if($role !== 'admin'){
            return redirect()->to('/index');
        }else{
            echo view("welcome_message",$data);
        }
    }

    public function tabel_harga_sawit()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surname = $sess->get('surname');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surname'] = $surname;

        $logged_in = $sess->get("logged_in");
        $role = $sess->get("role");
        echo view("admin/harga_tbs",$data);
    }

    public function input_harga_sawit()
    {
        $sess = session();
            $role = $sess->get('role');
            $username = $sess->get('username');
            $surname = $sess->get('surname');
    
            $data['role'] = $role;
            $data['username'] = $username;
            $data['surname'] = $surname;
    
            $logged_in = $sess->get("logged_in");
            $role = $sess->get("role");
        echo view("admin/input_harga_sawit",$data);
    }

    // public function users()
    // {
    //     echo view("admin/users");
    // }
    
}