<?php

namespace App\Models;

use CodeIgniter\Model;

class KhsModel extends Model
{
    protected $table            = 'krs';
    protected $primaryKey       = 'id';
   protected $allowedFields = ['id_mahasiswa', 'id_matakuliah', 'tahun_akademik', 'semester', 'nilai_angka'];
    public function getDataKhs($keyword = null)
    {
        $builder = $this->select('krs.*, data_mahasiswa.nama as nama_mhs, data_mahasiswa.nim, data_matakuliah.nama_mk, data_matakuliah.sks, data_matakuliah.kode_mk')
                        ->join('data_mahasiswa', 'data_mahasiswa.id = krs.id_mahasiswa')
                        ->join('data_matakuliah', 'data_matakuliah.id = krs.id_matakuliah');

        if ($keyword) {
            $builder->like('data_mahasiswa.nama', $keyword)
                    ->orLike('data_mahasiswa.nim', $keyword);
        }

        return $builder;
    }
    public function getKhsGrouped($keyword = null)
{
    $builder = $this->select('
            krs.id_mahasiswa, 
            data_mahasiswa.nama as nama_mhs, 
            data_mahasiswa.nim, 
            krs.semester, 
            krs.tahun_akademik,
            COUNT(krs.id_matakuliah) as total_mk,
            SUM(data_matakuliah.sks) as total_sks
        ')
        ->join('data_mahasiswa', 'data_mahasiswa.id = krs.id_mahasiswa')
        ->join('data_matakuliah', 'data_matakuliah.id = krs.id_matakuliah')
        ->groupBy('krs.id_mahasiswa, krs.semester, krs.tahun_akademik');

    if ($keyword) {
        $builder->groupStart()
                ->like('data_mahasiswa.nama', $keyword)
                ->orLike('data_mahasiswa.nim', $keyword)
                ->groupEnd();
    }

    return $builder;
}
}