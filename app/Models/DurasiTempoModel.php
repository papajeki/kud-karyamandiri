<?php

namespace App\Models;

use CodeIgniter\Model;

class DurasiTempoModel extends Model {
    protected $table = 'durasi_tempo';
    protected $primaryKey = 'id_durasi_tempo';
    protected $allowedFields = ['tempo'];
}
