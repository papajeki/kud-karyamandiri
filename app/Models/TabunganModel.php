<?php

namespace App\Models;

use CodeIgniter\Model;

class TabunganModel extends Model
{
    protected $table            = 'tabungan';
    protected $primaryKey       = 'id_tabungan';
    protected $allowedFields    = ['id_anggota','saldo','tanggal_buka','tanggal_tutup','status','jenis_tabungan'];
}