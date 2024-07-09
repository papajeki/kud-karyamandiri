<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemTerjualModel extends Model
{
    protected $table = 'item_terjual';
    protected $primaryKey = 'id_item_terjual';
    protected $allowedFields = ['id_penjualan', 'id_barang', 'id_stok', 'tanggal', 'id_users','jumlah','harga'];
}
