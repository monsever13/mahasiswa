<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    // Nama tabel sesuai dengan database Anda
    protected $table            = 'data_mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Field yang boleh diisi (sesuaikan dengan kolom di tabel data_mahasiswa Anda)
    protected $allowedFields    = [
        'nim', 
        'nama', 
        'jenis_kelamin', 
        'jurusan', 
        'alamat', 
        'email', 
        'telepon'
    ];

    // Aktifkan fitur otomatis catat waktu (opsional tapi berguna)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Fungsi untuk mencari mahasiswa berdasarkan NIM
     */
    public function getMahasiswaByNim($nim)
    {
        return $this->where(['nim' => $nim])->first();
    }
}