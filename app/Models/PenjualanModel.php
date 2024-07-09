<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $allowedFields    = ['struk', 'tanggal', 'id_users','total_belanja', 'metode_pembayaran','id_anggota'];
}
