<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = ['username', 'password', 'surename', 'roles','created_at','id_kelompok'];
}