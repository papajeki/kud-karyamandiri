<?php

namespace App\Models;

use CodeIgniter\Model;

class CreditsModel extends Model {
    protected $table = 'credits';
    protected $primaryKey = 'id_credits';
    protected $allowedFields = ['id_anggota','id_penjualan', 'status'];
}
