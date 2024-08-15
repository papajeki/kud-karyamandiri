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

    if($data){
        $pass = $data['password'];

        $verify_pass = password_verify($password, $pass);

        // if($verify_pass){
        //     $debugStr = "true";
        // }else{
        //     $debugStr = "false";
        // }
        
        if($verify_pass){
            $ses_data = [
                'id'       => $data['id'],
                'username'     => $data['username'],
                'surename'    => $data['surename'],
                'role' => $data['roles'],
                'logged_in'     => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/index');
        }else{
            $session->setFlashdata('msg',"wrongpassword");
            return redirect()->to('/login');
        }
    }else{
        $session->setFlashdata('msg', 'username not Found');
        return redirect()->to('/login');
    }

}

public function logout()
{
    // Hapus data sesi saat logout
    session()->destroy();
        return redirect()->to('/login');

    // Redirect ke halaman login setelah logout
}
 //$sandi = password_hash($password,PASSWORD_DEFAULT);
}