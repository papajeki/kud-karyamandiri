<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaSawit extends Model
{
protected $table = 'harga_sawit';
protected $primaryKey = 'id';
protected $allowedFields = ['tanggal_berlaku', 'harga', 'tanggal_berakhir'];
}