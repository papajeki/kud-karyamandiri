<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
protected $table = 'stok';
protected $primaryKey = 'id_stok';
protected $allowedFields = ['id_barang', 'kuantitas','harga_beli', 'terjual'];

public function getstokbarang($id_barang){
return $this->select('stok.id_stok, stok.id_barang, barang.nama_barang, stok.tanggal, stok.kuantitas, stok.harga_beli, stok.terjual')
->join('barang', 'barang.id_barang = stok.id_barang')
->where('stok.id_barang', $id_barang)
->findAll();
}

}