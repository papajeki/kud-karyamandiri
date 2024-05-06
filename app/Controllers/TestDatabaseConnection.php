<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use app\Models\UserModel;

class TestDatabaseConnection extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect(); // Membuat koneksi database

        if ($db->connect()) {
            echo 'Koneksi berhasil!'; // Pesan ini akan ditampilkan jika koneksi berhasil
        } else {
            echo 'Koneksi gagal!'; // Pesan ini akan ditampilkan jika koneksi gagal
        }
    }
}