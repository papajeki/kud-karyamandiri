<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['result'] = $model->findAll();
        return view("admin/users",$data);
    }
    public function simpan()
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'surename' => $this->request->getPost('surename'),
            'roles' => $this->request->getPost('roles'),];
            $model->insert($data);
    
            return redirect()->to("admin/create_user");
        }

    public function create_user()
    {
        return view("admin/create_user");
    }
}
