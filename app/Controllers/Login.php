<?php 

namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index(){
        $ModelMember = new \App\Models\UserModel();
              return view("login");
}

public function process()
{
    $session = session();
    $model = new UserModel();
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    $data = $model->where('username', $username)->first();
    $pass = $data['password'];

    if($data){
        $verify_pass = password_verify($password, $pass);
        if($verify_pass){
            $ses_data = [
                'id'       => $data['id'],
                'username'     => $data['username'],
                'surename'    => $data['surename'],
                'logged_in'     => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/dashboard_admin');
        }else{
            $session->setFlashdata('msg','Wrong Password');
            return redirect()->to('/login');
        }
    }else{
        $session->setFlashdata('msg', 'username not Found');
        return redirect()->to('/login');
    }

}

public function logout()
{
    // Hapus data pengguna dari sesi saat logout
    $session = session();
    $session->remove('user');

    // Redirect ke halaman login setelah logout
    return redirect()->to('/login');
}
 //$sandi = password_hash($password,PASSWORD_DEFAULT);
}