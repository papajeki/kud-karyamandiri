<?php
namespace App\Models;
use CodeIgniter\Model;

class GajiAnggotaModel extends Model {
    protected $table = 'gaji_anggota';
    protected $primaryKey = 'id_gaji';
    protected $allowedFields = ['id_anggota', 'id_kelompok', 'tanggal_penyaluran', 'total_hasil_panen','total_potongan', 'total_credits','total_gaji_bersih'];
}