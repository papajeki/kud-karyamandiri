<?php

namespace App\Models;

use CodeIgniter\Model;

class KelompokTaniModel extends Model
{
    protected $table = 'kelompok_tani';
    protected $primaryKey = 'id_kelompoktani';
    protected $allowedFields = ['kelompok_tani', 'id_ketua'];
}
