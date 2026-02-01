<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MatakuliahModel;

class Absensi extends BaseController
{
    protected $absensiModel;
    protected $mahasiswaModel;
    protected $dosenModel;
    protected $matakuliahModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->dosenModel = new DosenModel();
        $this->matakuliahModel = new MatakuliahModel();
    }

    /**
     * Tampilkan semua data absensi
     */
    public function index()
{
    // Ambil parameter filter
    $filter_matakuliah = $this->request->getGet('matakuliah');
    $filter_dosen = $this->request->getGet('dosen');
    $filter_tahun = $this->request->getGet('tahun');
    $filter_semester = $this->request->getGet('semester');
    
    // Pagination config
    $perPage = 25; // Data per halaman
    $currentPage = $this->request->getGet('page') ?? 1;
    $offset = ($currentPage - 1) * $perPage;

    // Query builder untuk pagination
    $builder = $this->absensiModel->db->table('absensi');
    $builder->select('absensi.*, 
        data_mahasiswa.nim, 
        data_mahasiswa.nama as nama_mahasiswa,
        data_matakuliah.nama_mk,
        data_dosen.nama_dosen');
    
    $builder->join('data_mahasiswa', 'data_mahasiswa.id = absensi.id_mahasiswa');
    $builder->join('data_matakuliah', 'data_matakuliah.id = absensi.id_matakuliah');
    $builder->join('data_dosen', 'data_dosen.id = absensi.id_dosen');
    
    // Filter
    if ($filter_matakuliah) {
        $builder->where('absensi.id_matakuliah', $filter_matakuliah);
    }
    if ($filter_dosen) {
        $builder->where('absensi.id_dosen', $filter_dosen);
    }
    if ($filter_tahun) {
        $builder->where('absensi.tahun_akademik', $filter_tahun);
    }
    if ($filter_semester) {
        $builder->where('absensi.semester', $filter_semester);
    }
    
    $builder->orderBy('absensi.tgl_absen', 'DESC');
    $builder->orderBy('absensi.pertemuan_ke', 'ASC');
    
    // Hitung total data (untuk pagination)
    $totalData = $builder->countAllResults(false); // false = tidak reset query
    
    // Ambil data dengan limit & offset
    $builder->limit($perPage, $offset);
    $absensi = $builder->get()->getResultArray();
    
    // Buat pagination
    $pager = \Config\Services::pager();
    $pager->makeLinks($currentPage, $perPage, $totalData);
    
    $data = [
        'title' => 'Data Absensi',
        'absensi' => $absensi,
        'mahasiswa' => $this->mahasiswaModel->findAll(),
        'dosen' => $this->dosenModel->findAll(),
        'matakuliah' => $this->matakuliahModel->findAll(),
        'filter_matakuliah' => $filter_matakuliah,
        'filter_dosen' => $filter_dosen,
        'filter_tahun' => $filter_tahun,
        'filter_semester' => $filter_semester,
        'pager' => $pager,
        'totalData' => $totalData,
        'currentPage' => $currentPage,
        'perPage' => $perPage
    ];

    return view('absensi/index', $data);
}

    /**
     * Form tambah absensi
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Absensi',
            'mahasiswa' => $this->mahasiswaModel->findAll(),
            'dosen' => $this->dosenModel->findAll(),
            'matakuliah' => $this->matakuliahModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('absensi/create', $data);
    }

    /**
     * Simpan data absensi baru
     */
    public function store()
    {
        // Validasi input
        $rules = [
            'id_mahasiswa' => 'required|numeric',
            'id_matakuliah' => 'required|numeric',
            'id_dosen' => 'required|numeric',
            'tgl_absen' => 'required|valid_date',
            'pertemuan_ke' => 'required|numeric|greater_than[0]|less_than[17]',
            'status' => 'required|in_list[H,I,S,A]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data dari form
        $data = [
            'id_mahasiswa' => $this->request->getPost('id_mahasiswa'),
            'id_matakuliah' => $this->request->getPost('id_matakuliah'),
            'id_dosen' => $this->request->getPost('id_dosen'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik') ?? '2025/2026',
            'semester' => $this->request->getPost('semester') ?? '7',
            'tgl_absen' => $this->request->getPost('tgl_absen'),
            'pertemuan_ke' => $this->request->getPost('pertemuan_ke'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Simpan ke database
        if ($this->absensiModel->save($data)) {
            return redirect()->to('/absensi')->with('success', 'Data absensi berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data absensi');
        }
    }

    /**
     * Form edit absensi
     */
    public function edit($id)
    {
        $absensi = $this->absensiModel->find($id);
        
        if (!$absensi) {
            return redirect()->to('/absensi')->with('error', 'Data absensi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Absensi',
            'absensi' => $absensi,
            'mahasiswa' => $this->mahasiswaModel->findAll(),
            'dosen' => $this->dosenModel->findAll(),
            'matakuliah' => $this->matakuliahModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('absensi/edit', $data);
    }

    /**
     * Update data absensi
     */
    public function update($id)
    {
        // Validasi
        $rules = [
            'id_mahasiswa' => 'required|numeric',
            'id_matakuliah' => 'required|numeric',
            'id_dosen' => 'required|numeric',
            'tgl_absen' => 'required|valid_date',
            'pertemuan_ke' => 'required|numeric|greater_than[0]|less_than[17]',
            'status' => 'required|in_list[H,I,S,A]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data update
        $data = [
            'id_mahasiswa' => $this->request->getPost('id_mahasiswa'),
            'id_matakuliah' => $this->request->getPost('id_matakuliah'),
            'id_dosen' => $this->request->getPost('id_dosen'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
            'semester' => $this->request->getPost('semester'),
            'tgl_absen' => $this->request->getPost('tgl_absen'),
            'pertemuan_ke' => $this->request->getPost('pertemuan_ke'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        if ($this->absensiModel->update($id, $data)) {
            return redirect()->to('/absensi')->with('success', 'Data absensi berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data absensi');
        }
    }

    /**
     * Hapus data absensi
     */
    public function delete($id)
    {
        // Cek data ada
        $absensi = $this->absensiModel->find($id);
        
        if (!$absensi) {
            return redirect()->to('/absensi')->with('error', 'Data tidak ditemukan');
        }

        if ($this->absensiModel->delete($id)) {
            return redirect()->to('/absensi')->with('success', 'Data absensi berhasil dihapus');
        } else {
            return redirect()->to('/absensi')->with('error', 'Gagal menghapus data absensi');
        }
    }

    /**
     * Input absensi batch (multiple mahasiswa)
     */
    public function batch()
    {
        $data = [
            'title' => 'Input Absensi Batch',
            'mahasiswa' => $this->mahasiswaModel->findAll(),
            'dosen' => $this->dosenModel->findAll(),
            'matakuliah' => $this->matakuliahModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('absensi/batch', $data);
    }

    /**
     * Simpan absensi batch
     */
    public function storeBatch()
    {
        $mahasiswa_ids = $this->request->getPost('mahasiswa_ids');
        $id_matakuliah = $this->request->getPost('id_matakuliah');
        $id_dosen = $this->request->getPost('id_dosen');
        $tgl_absen = $this->request->getPost('tgl_absen');
        $pertemuan_ke = $this->request->getPost('pertemuan_ke');
        $status = $this->request->getPost('status') ?? 'H';

        if (empty($mahasiswa_ids)) {
            return redirect()->back()->with('error', 'Pilih minimal satu mahasiswa');
        }

        $successCount = 0;
        foreach ($mahasiswa_ids as $id_mahasiswa) {
            $data = [
                'id_mahasiswa' => $id_mahasiswa,
                'id_matakuliah' => $id_matakuliah,
                'id_dosen' => $id_dosen,
                'tahun_akademik' => $this->request->getPost('tahun_akademik') ?? '2025/2026',
                'semester' => $this->request->getPost('semester') ?? '7',
                'tgl_absen' => $tgl_absen,
                'pertemuan_ke' => $pertemuan_ke,
                'status' => $status,
                'keterangan' => $this->request->getPost('keterangan')
            ];

            if ($this->absensiModel->save($data)) {
                $successCount++;
            }
        }

        return redirect()->to('/absensi')->with('success', "Berhasil menyimpan absensi untuk {$successCount} mahasiswa");
    }

    /**
     * Laporan absensi (nanti disesuaikan dengan format Excel)
     */
    public function laporan()
    {
        $data = [
            'title' => 'Laporan Absensi',
            'mahasiswa' => $this->mahasiswaModel->findAll(),
            'dosen' => $this->dosenModel->findAll(),
            'matakuliah' => $this->matakuliahModel->findAll()
        ];

        return view('absensi/laporan', $data);
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
        data_matakuliah.nama_mk,  // HAPUS kode_mk
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
 * Print data absensi
 */
public function print()
{
    // Ambil parameter filter (sama seperti index)
    $filter_matakuliah = $this->request->getGet('matakuliah');
    $filter_dosen = $this->request->getGet('dosen');
    $filter_tahun = $this->request->getGet('tahun');
    $filter_semester = $this->request->getGet('semester');
    
    // Query builder (TANPA PAGINATION LIMIT)
    $builder = $this->absensiModel->db->table('absensi');
    $builder->select('absensi.*, 
        data_mahasiswa.nim, 
        data_mahasiswa.nama as nama_mahasiswa,
        data_matakuliah.nama_mk,
        data_dosen.nama_dosen');
    
    $builder->join('data_mahasiswa', 'data_mahasiswa.id = absensi.id_mahasiswa');
    $builder->join('data_matakuliah', 'data_matakuliah.id = absensi.id_matakuliah');
    $builder->join('data_dosen', 'data_dosen.id = absensi.id_dosen');
    
    // Filter (sama seperti index)
    if ($filter_matakuliah) {
        $builder->where('absensi.id_matakuliah', $filter_matakuliah);
    }
    if ($filter_dosen) {
        $builder->where('absensi.id_dosen', $filter_dosen);
    }
    if ($filter_tahun) {
        $builder->where('absensi.tahun_akademik', $filter_tahun);
    }
    if ($filter_semester) {
        $builder->where('absensi.semester', $filter_semester);
    }
    
    $builder->orderBy('data_mahasiswa.nim', 'ASC');
    $builder->orderBy('absensi.tgl_absen', 'ASC');
    
    $absensi = $builder->get()->getResultArray();
    
    // Get filter details for title
    $filter_details = [];
    if ($filter_matakuliah) {
        $mk = $this->matakuliahModel->find($filter_matakuliah);
        $filter_details['matakuliah'] = $mk ? $mk['nama_mk'] : '';
    }
    if ($filter_dosen) {
        $dsn = $this->dosenModel->find($filter_dosen);
        $filter_details['dosen'] = $dsn ? $dsn['nama_dosen'] : '';
    }
    
    $data = [
        'title' => 'Laporan Absensi',
        'absensi' => $absensi,
        'filter_details' => $filter_details,
        'filter_tahun' => $filter_tahun,
        'filter_semester' => $filter_semester,
        'total_data' => count($absensi),
        'print_date' => date('d/m/Y H:i:s')
    ];
    
    return view('absensi/print', $data);
}


}