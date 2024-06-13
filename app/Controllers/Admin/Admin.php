<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HargaSawit;

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
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;
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
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;

        $logged_in = $sess->get("logged_in");
        $role = $sess->get("role");

        $model = new HargaSawit();
        $data['result'] = $model->findAll();
        echo view("admin/harga_tbs",$data);
    }

    public function input_harga_sawit()
    {
        $sess = session();
            $role = $sess->get('role');
            $username = $sess->get('username');
            $surename = $sess->get('surename');
    
            $data['role'] = $role;
            $data['username'] = $username;
            $data['surename'] = $surename;
            $model = new HargaSawit();
            $data['harga_sawit'] = $model->orderBy('tanggal_berlaku', 'desc')->first();
            
            if ($this->request->getMethod() === 'post'){
            $update = [
                'tanggal_berlaku' => $this->request->getPost('tanggal_berlaku'),
                'harga' => $this->request->getPost('harga'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir')
            ];
            $model->insert($update);
            var_dump($update);
            return redirect("admin/harga_tbs");
        }
        return view("admin/input_harga_sawit",$data);
    }

    // public function users()
    // {
    //     echo view("admin/users");
    // }
    
}