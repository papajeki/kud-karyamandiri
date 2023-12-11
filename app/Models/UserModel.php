<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Ganti 'users' dengan nama tabel yang sesuai
    protected $primaryKey = 'id'; // Kolom primary key
    protected $allowedFields = ['username', 'password', 'roles']; // Kolom yang dapat diisi

    public function checkLogin($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return data user jika login berhasil
        } else {
            return false; // Return false jika login gagal
        }
    }
}