<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'data_dosen';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nidn', 'nama_dosen', 'email', 'spesialisasi'];
    protected $useTimestamps    = true; // Mengaktifkan created_at dan updated_at otomatis
}