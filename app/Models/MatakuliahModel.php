<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table            = 'data_matakuliah';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode_mk', 'nama_mk', 'sks', 'id_dosen'];
    protected $useTimestamps    = false;

    // Ganti nama method menjadi getMatakuliahFull agar sesuai dengan Controller KRS
    public function getMatakuliahFull($id = null)
    {
        $builder = $this->select('data_matakuliah.*, data_dosen.nama_dosen')
                        ->join('data_dosen', 'data_dosen.id = data_matakuliah.id_dosen');

        if ($id === null) {
            return $builder->findAll();
        }

        return $builder->where(['data_matakuliah.id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->select('data_matakuliah.*, data_dosen.nama_dosen')
                    ->join('data_dosen', 'data_dosen.id = data_matakuliah.id_dosen')
                    ->groupStart() // Tambahkan ini agar pencarian lebih akurat
                        ->like('nama_mk', $keyword)
                        ->orLike('kode_mk', $keyword)
                        ->orLike('nama_dosen', $keyword)
                    ->groupEnd();
    }
}