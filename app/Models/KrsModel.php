<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
    protected $table            = 'krs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    
    // Kolom yang wajib sama dengan di database Anda
    protected $allowedFields    = [
        'id_mahasiswa', 
        'id_matakuliah', 
        'tahun_akademik', 
        'semester', 
        'nilai_angka'
    ];

    // Dimatikan agar tidak error "Unknown column updated_at"
    protected $useTimestamps = false;

    /**
     * getKrsGrouped
     * Dipakai di halaman INDEX (Tampilan Utama)
     * Menggabungkan banyak mata kuliah menjadi satu baris per mahasiswa/semester
     */
    public function getKrsGrouped($keyword = null)
    {
        $builder = $this->select('
                MAX(krs.id) as id, 
                krs.id_mahasiswa, 
                data_mahasiswa.nama as nama_mhs, 
                data_mahasiswa.nim, 
                GROUP_CONCAT(data_matakuliah.nama_mk SEPARATOR "<br>") as daftar_mk, 
                SUM(data_matakuliah.sks) as total_sks,
                krs.tahun_akademik,
                krs.semester
            ')
            ->join('data_mahasiswa', 'data_mahasiswa.id = krs.id_mahasiswa')
            ->join('data_matakuliah', 'data_matakuliah.id = krs.id_matakuliah')
            ->groupBy('krs.id_mahasiswa, krs.tahun_akademik, krs.semester')
            ->orderBy('krs.id', 'DESC');

        if ($keyword) {
            $builder->groupStart()
                    ->like('data_mahasiswa.nama', $keyword)
                    ->orLike('data_mahasiswa.nim', $keyword)
                    ->orLike('krs.semester', $keyword)
                    ->groupEnd();
        }

        return $builder;
    }

    /**
     * getKhsLengkap
     * Dipakai di halaman CETAK (Print)
     * Menampilkan semua detail mata kuliah tanpa digabung (per baris)
     */
    public function getKhsLengkap()
    {
        return $this->select('
                krs.*, 
                data_mahasiswa.nama as nama_mhs, 
                data_mahasiswa.nim, 
                data_matakuliah.nama_mk, 
                data_matakuliah.kode_mk, 
                data_matakuliah.sks
            ')
            ->join('data_mahasiswa', 'data_mahasiswa.id = krs.id_mahasiswa')
            ->join('data_matakuliah', 'data_matakuliah.id = krs.id_matakuliah');
    }

    /**
     * getKrsLengkap
     * Alias jika Controller memanggil nama ini
     */
    public function getKrsLengkap($keyword = null)
    {
        return $this->getKrsGrouped($keyword);
    }
}