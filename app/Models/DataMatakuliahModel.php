<?php

namespace App\Models;

use CodeIgniter\Model;

class DataMatakuliahModel extends Model
{
    protected $table            = 'data_matakuliah'; // Sesuaikan dengan nama tabel di MySQL
    protected $primaryKey       = 'id';
    protected $allowedFields = ['kode', 'nama_mk', 'sks']; // Contoh jika namanya 'kode' dan 'nama_mk';
}