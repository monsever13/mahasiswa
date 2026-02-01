<?php

namespace App\Models;

use CodeIgniter\Model;

class DataMahasiswaModel extends Model
{
    protected $table            = 'data_mahasiswa';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['kode_matakuliah', 'nama_matakuliah', 'sks', 'semester'];
}