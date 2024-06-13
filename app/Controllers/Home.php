<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {  $sess = session();
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
    public function main()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;
        // $logged_in = $sess->get("logged_in");
        // $role = $sess->get("role");

        echo view("select_role",$data);
    }
}
