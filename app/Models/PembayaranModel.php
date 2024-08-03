<?php
 namespace App\Models;
 use codeigniter\Model;

 class PembayaranModel extends Model{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id_pembayaran';
    protected $allowedFields    = ['id_pinjaman', 'id_anggota', 'nominal_pembayaran','tanggal_bayar', 'deskripsi'];
 }
