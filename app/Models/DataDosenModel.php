<?php

namespace App\Models;

use CodeIgniter\Model;

class DataDosenModel extends Model
{
    protected $table            = 'data_dosen';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nidn', 'nama_dosen', 'email'];
}