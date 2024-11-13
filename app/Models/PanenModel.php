<?php

namespace App\Models;
use CodeIgniter\Model;

class PanenModel extends Model {
    protected $table = 'panen';
    protected $primaryKey = 'id_panen';
    protected $allowedFields = ['id_anggota', 'tanggal_panen','berat_panen', 'harga_tbs','id_kelompok','is_paid_off'];
}