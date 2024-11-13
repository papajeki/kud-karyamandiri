<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\KelompokTaniModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class Users extends BaseController
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
        
        $model = new UserModel();
        $data['result'] = $model->findAll();
        return view("admin/users",$data);
    }
    public function simpan()
    {
        $model = new UserModel();
        $kelompokModel = new KelompokTaniModel();
        
        // Menyiapkan data pengguna
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'surename' => $this->request->getPost('surename'),
            'roles' => $this->request->getPost('roles')
        ];
        
        // Menyimpan data pengguna
        $model->insert($data);
        
        // Mendapatkan ID pengguna yang baru saja dibuat
        $userId = $model->getInsertID();
        
        // Jika roles adalah "petani", simpan id_ketua di tabel kelompok_tani
        if ($data['roles'] === 'petani') {
            $kelompokId = $this->request->getPost('kelompok');
            
            // Update id_ketua di kelompok_tani
            $kelompokModel->update($kelompokId, ['id_ketua' => $userId]);
        }
        
        return redirect()->to("admin/users");
    }
    
    public function create_user()
    {
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;

        $model = new KelompokTaniModel;
        $data['kelompok'] = $model->findAll();

        return view("admin/create_user",$data);
    }

    public function edit_user($id){
        $sess = session();
        $role = $sess->get('role');
        $username = $sess->get('username');
        $surename = $sess->get('surename');

        $data['role'] = $role;
        $data['username'] = $username;
        $data['surename'] = $surename;
        //data users
        $model = new UserModel();
        $data['users'] = $model->where('id',$id)->first();


        return view("admin/edit_user",$data);
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

    public function update($id)
    {
        $model = new UserModel();
        
        // Data yang akan diupdate
        $data = [
            'surename' => $this->request->getPost('surename'),
            'roles' => $this->request->getPost('roles')
        ];
    
        // Jika password diisi, maka update password
        $password =$this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
    
        // Update data ke database
        $model->update($id, $data);
        
        return redirect()->to('/admin/users');
    }
    
}
