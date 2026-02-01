<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    // Nama tabel
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    // Kolom yang boleh diisi
    protected $allowedFields = [
        'id_mahasiswa',
        'id_matakuliah',
        'id_dosen',
        'tahun_akademik',
        'semester',
        'tgl_absen',
        'pertemuan_ke',
        'status',
        'keterangan'
    ];
    
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    
    // Validation
    protected $validationRules = [
        'id_mahasiswa' => 'required|numeric',
        'id_matakuliah' => 'required|numeric',
        'id_dosen' => 'required|numeric',
        'tgl_absen' => 'required|valid_date',
        'pertemuan_ke' => 'required|numeric|greater_than[0]|less_than[17]',
        'status' => 'required|in_list[H,I,S,A]'
    ];
    
    protected $validationMessages = [
        'id_mahasiswa' => [
            'required' => 'Mahasiswa harus dipilih',
            'numeric' => 'ID mahasiswa harus angka'
        ],
        'id_matakuliah' => [
            'required' => 'Mata kuliah harus dipilih',
            'numeric' => 'ID mata kuliah harus angka'
        ],
        'id_dosen' => [
            'required' => 'Dosen harus dipilih',
            'numeric' => 'ID dosen harus angka'
        ],
        'pertemuan_ke' => [
            'greater_than' => 'Pertemuan harus antara 1-16',
            'less_than' => 'Pertemuan harus antara 1-16'
        ]
    ];
    
    protected $skipValidation = false;
    
    /**
     * Ambil semua data absensi dengan join ke tabel terkait
     */
    /**
 * Ambil semua data absensi dengan join ke tabel terkait
 */
public function getAllAbsensi()
{
    $builder = $this->db->table($this->table);
    $builder->select('
        absensi.*,
        data_mahasiswa.nim,
        data_mahasiswa.nama as nama_mahasiswa,
        data_matakuliah.nama_mk,  // HAPUS kode_mk jika tidak ada
        data_dosen.nama_dosen
    ');
    
    $builder->join('data_mahasiswa', 'data_mahasiswa.id = absensi.id_mahasiswa');
    $builder->join('data_matakuliah', 'data_matakuliah.id = absensi.id_matakuliah');
    $builder->join('data_dosen', 'data_dosen.id = absensi.id_dosen');
    
    $builder->orderBy('absensi.tgl_absen', 'DESC');
    $builder->orderBy('absensi.pertemuan_ke', 'ASC');
    $builder->orderBy('data_mahasiswa.nim', 'ASC');
    
    return $builder->get()->getResultArray();
}
    
    /**
     * Ambil absensi berdasarkan filter
     */
    public function getAbsensiByFilter($id_matakuliah = null, $id_dosen = null, $tahun_akademik = null, $semester = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            absensi.*,
            data_mahasiswa.nim,
            data_mahasiswa.nama as nama_mahasiswa,
            data_matakuliah.nama_mk,
            data_dosen.nama_dosen
        ');
        
        $builder->join('data_mahasiswa', 'data_mahasiswa.id = absensi.id_mahasiswa');
        $builder->join('data_matakuliah', 'data_matakuliah.id = absensi.id_matakuliah');
        $builder->join('data_dosen', 'data_dosen.id = absensi.id_dosen');
        
        // Filter
        if ($id_matakuliah) {
            $builder->where('absensi.id_matakuliah', $id_matakuliah);
        }
        if ($id_dosen) {
            $builder->where('absensi.id_dosen', $id_dosen);
        }
        if ($tahun_akademik) {
            $builder->where('absensi.tahun_akademik', $tahun_akademik);
        }
        if ($semester) {
            $builder->where('absensi.semester', $semester);
        }
        
        $builder->orderBy('absensi.tgl_absen', 'DESC');
        $builder->orderBy('absensi.pertemuan_ke', 'ASC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Ambil absensi per mahasiswa
     */
    public function getAbsensiByMahasiswa($id_mahasiswa)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            absensi.*,
            data_matakuliah.kode_mk,
            data_matakuliah.nama_mk,
            data_dosen.nama_dosen
        ');
        
        $builder->join('data_matakuliah', 'data_matakuliah.id = absensi.id_matakuliah');
        $builder->join('data_dosen', 'data_dosen.id = absensi.id_dosen');
        
        $builder->where('absensi.id_mahasiswa', $id_mahasiswa);
        $builder->orderBy('absensi.tgl_absen', 'DESC');
        
        return $builder->get()->getResultArray();
    }
    
    /**
     * Cek apakah absensi sudah ada (untuk menghindari duplikasi)
     */
    public function isDuplicate($id_mahasiswa, $id_matakuliah, $tgl_absen, $pertemuan_ke)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_mahasiswa', $id_mahasiswa);
        $builder->where('id_matakuliah', $id_matakuliah);
        $builder->where('tgl_absen', $tgl_absen);
        $builder->where('pertemuan_ke', $pertemuan_ke);
        
        return $builder->countAllResults() > 0;
    }
    
    /**
     * Hitung total hadir per mahasiswa per mata kuliah
     */
    public function getTotalHadir($id_mahasiswa, $id_matakuliah = null, $tahun_akademik = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(*) as total_hadir");
        $builder->where('id_mahasiswa', $id_mahasiswa);
        $builder->where('status', 'H'); // Hanya yang hadir
        
        if ($id_matakuliah) {
            $builder->where('id_matakuliah', $id_matakuliah);
        }
        if ($tahun_akademik) {
            $builder->where('tahun_akademik', $tahun_akademik);
        }
        
        $result = $builder->get()->getRowArray();
        return $result['total_hadir'] ?? 0;
    }
    
    /**
     * Ambil data untuk laporan format Excel (nanti)
     */
    public function getDataForExcelReport($id_matakuliah, $id_dosen, $tahun_akademik, $semester)
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            data_mahasiswa.nim,
            data_mahasiswa.nama as nama_mahasiswa,
            absensi.semester,
            GROUP_CONCAT(
                CASE absensi.pertemuan_ke 
                    WHEN 1 THEN absensi.status 
                    ELSE NULL 
                END
            ) as p1,
            GROUP_CONCAT(
                CASE absensi.pertemuan_ke 
                    WHEN 2 THEN absensi.status 
                    ELSE NULL 
                END
            ) as p2,
            -- Lanjutkan sampai p16 nanti
        ');
        
        $builder->join('data_mahasiswa', 'data_mahasiswa.id = absensi.id_mahasiswa');
        
        $builder->where('absensi.id_matakuliah', $id_matakuliah);
        $builder->where('absensi.id_dosen', $id_dosen);
        $builder->where('absensi.tahun_akademik', $tahun_akademik);
        $builder->where('absensi.semester', $semester);
        
        $builder->groupBy('data_mahasiswa.id');
        $builder->orderBy('data_mahasiswa.nim', 'ASC');
        
        return $builder->get()->getResultArray();
    }
}