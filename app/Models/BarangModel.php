<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
protected $table = 'barang';
protected $primaryKey = 'id_barang';
protected $allowedFields = ['barcode', 'nama_barang','harga_jual'];
}