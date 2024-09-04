<?php
namespace App\Models;

use CodeIgniter\Model;
class PotonganModel extends Model {
    protected $table = 'potongan_kelompok';
    protected $primaryKey = 'id_potongan_kelompok';
    protected $allowedFields = ['deskripsi','nominal','id_kelompok'];
}