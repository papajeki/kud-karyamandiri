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
            'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
            'surename' => $this->request->getPost('surename'),
            'roles' => $this->request->getPost('roles'),];
            $model->insert($data);
    
            return redirect()->to("admin/users");
        }

    public function create_user()
    {
        return view("admin/create_user");
    }
    public function delete($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user) {
            $model->delete($id);
            session()->setFlashdata('success', 'User deleted successfully');
        } else {
            session()->setFlashdata('error', 'User not found');
        }

        return redirect()->to('/admin/users'); // Sesuaikan dengan halaman yang benars
    }
}
