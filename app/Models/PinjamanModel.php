<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model {
    protected $table = 'pinjaman';
    protected $primaryKey = 'id_pinjaman';
    protected $allowedFields = ['id_anggota', 'nominal_pinjaman', 'tanggal_pinjaman', 'angsuran', 'bunga', 'tagihan', 'status', 'bukti_disetujui'];
}
