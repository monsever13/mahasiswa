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
    
    // Kolom yang diizinkan untuk diisi (Insert/Update)
    protected $allowedFields    = [
        'id_mahasiswa', 
        'id_matakuliah', 
        'tahun_akademik', 
        'semester', 
        'nilai_angka'
    ];

    // Aktifkan fitur pencatatan waktu otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * getKrsGrouped
     * Digunakan untuk menampilkan 1 baris per mahasiswa di halaman utama KRS.
     * Menggabungkan banyak mata kuliah menjadi satu string (GROUP_CONCAT).
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
            // Mengelompokkan agar data per semester tidak melebur jadi satu
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
     * getKrsDetail
     * Mengambil data per baris mata kuliah. 
     * Digunakan untuk halaman Edit, Input Nilai, atau Cetak KHS.
     */
    public function getKrsDetail($id_mahasiswa = null, $semester = null)
    {
        $builder = $this->select('
                krs.*, 
                data_mahasiswa.nama as nama_mhs, 
                data_mahasiswa.nim, 
                data_matakuliah.nama_mk, 
                data_matakuliah.kode_mk, 
                data_matakuliah.sks
            ')
            ->join('data_mahasiswa', 'data_mahasiswa.id = krs.id_mahasiswa')
            ->join('data_matakuliah', 'data_matakuliah.id = krs.id_matakuliah');

        if ($id_mahasiswa) {
            $builder->where('krs.id_mahasiswa', $id_mahasiswa);
        }
        
        if ($semester) {
            $builder->where('krs.semester', $semester);
        }

        return $builder;
    }

    /**
     * Validasi: Mencegah mahasiswa mengambil MK yang sama di semester yang sama
     */
    public function isDuplicate($id_mhs, $id_mk, $sem, $ta)
    {
        return $this->where([
            'id_mahasiswa'   => $id_mhs,
            'id_matakuliah'  => $id_mk,
            'semester'       => $sem,
            'tahun_akademik' => $ta
        ])->first();
    }
}