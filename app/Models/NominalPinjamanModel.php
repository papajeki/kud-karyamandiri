<?php 

namespace App\Models;
use CodeIgniter\Model;

class NominalPinjamanModel extends Model {
    protected $table = 'nilai_pinjaman';
    protected $primaryKey = 'id_nilai_pinjaman';
    protected $allowedFields = ['nilai_pinjaman'];
}