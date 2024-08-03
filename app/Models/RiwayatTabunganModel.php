<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatTabunganModel extends Model
{
    protected $table            = 'riwayat_tabungan';
    protected $primaryKey       = 'id_riwayat_tabungan';
    protected $allowedFields    = ['id_anggota','id_tabungan', 'jenis_transaksi', 'jumlah','tanggal', 'deskripsi'];
}
