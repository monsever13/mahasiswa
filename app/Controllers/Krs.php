<?php

namespace App\Controllers;

use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\MatakuliahModel;

class Krs extends BaseController
{
    protected $krs, $mhs, $mk;

    public function __construct()
    {
        $this->krs = new KrsModel();
        $this->mhs = new MahasiswaModel();
        $this->mk  = new MatakuliahModel();
    }

    // 1. Halaman Utama (Index)
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $data = [
            'title'   => 'Data KRS Mahasiswa',
            'krs'     => $this->krs->getKrsGrouped($keyword)->paginate(10, 'krs'),
            'pager'   => $this->krs->getKrsGrouped($keyword)->pager,
            'keyword' => $keyword
        ];
        return view('krs/index', $data);
    }

    // 2. Form Tambah KRS (Method yang sebelumnya Hilang/404)
    public function create()
    {
        $data = [
            'title'      => 'Tambah KRS Baru',
            'mahasiswa'  => $this->mhs->findAll(),
            'matakuliah' => $this->mk->findAll()
        ];
        return view('krs/create', $data);
    }

    // 3. Proses Simpan Awal
    public function store()
    {
        $id_mk_list = $this->request->getPost('id_mk');
        if ($id_mk_list) {
            foreach ($id_mk_list as $id_mk) {
                $this->krs->insert([
                    'id_mahasiswa'   => $this->request->getPost('id_mahasiswa'),
                    'id_matakuliah'  => $id_mk,
                    'tahun_akademik' => $this->request->getPost('tahun_akademik'),
                    'semester'       => $this->request->getPost('semester')
                ]);
            }
        }
        return redirect()->to('/krs')->with('pesan', 'Data KRS berhasil disimpan.');
    }

    // 4. Halaman Edit (Shopping Cart Style)
    public function edit($id)
    {
        $krs_row = $this->krs->find($id);
        if (!$krs_row) return redirect()->to('/krs');

        $data = [
            'title'      => 'Kelola KRS: ' . $krs_row['id_mahasiswa'],
            'krs'        => $krs_row,
            'matakuliah' => $this->mk->findAll(),
            'daftar_mk'  => $this->krs->getKhsLengkap()
                                ->where('krs.id_mahasiswa', $krs_row['id_mahasiswa'])
                                ->where('krs.semester', $krs_row['semester'])
                                ->where('krs.tahun_akademik', $krs_row['tahun_akademik'])
                                ->findAll()
        ];
        return view('krs/edit', $data);
    }

    // 5. Update Semester & Tahun (Massal)
    public function update_info()
    {
        $id_mhs = $this->request->getPost('id_mahasiswa');
        $smt_lama = $this->request->getPost('semester_lama');
        $thn_lama = $this->request->getPost('tahun_lama');

        $smt_baru = $this->request->getPost('semester');
        $thn_baru = $this->request->getPost('tahun_akademik');

        $this->krs->where([
            'id_mahasiswa' => $id_mhs,
            'semester' => $smt_lama,
            'tahun_akademik' => $thn_lama
        ])->set([
            'semester' => $smt_baru,
            'tahun_akademik' => $thn_baru
        ])->update();

        $new_row = $this->krs->where(['id_mahasiswa' => $id_mhs, 'semester' => $smt_baru])->first();
        return redirect()->to('/krs/edit/' . $new_row['id'])->with('pesan', 'Identitas KRS diperbarui.');
    }

    // 6. Tambah Item Mata Kuliah ke KRS
    public function add_item()
    {
        $this->krs->insert([
            'id_mahasiswa'   => $this->request->getPost('id_mahasiswa'),
            'id_matakuliah'  => $this->request->getPost('id_matakuliah'),
            'semester'       => $this->request->getPost('semester'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
        ]);
        return redirect()->back()->with('pesan', 'Mata kuliah ditambahkan.');
    }

    // 7. Hapus Item Mata Kuliah dari KRS
    public function delete($id)
    {
        $this->krs->delete($id);
        return redirect()->back()->with('pesan', 'Item berhasil dihapus.');
    }

    // Cetak Seluruh Data KRS yang ada di database
public function print_all()
{
    $data = [
        'title' => 'Laporan Seluruh KRS Mahasiswa',
        'krs'   => $this->krs->getKrsGrouped()->findAll()
    ];
    return view('krs/print_all', $data);
}

// Cetak KRS per Mahasiswa (KRS Lembar Satuan)
public function print_individu($id_mhs)
{
    $smt = $this->request->getGet('smt');
    $thn = $this->request->getGet('thn');

    $data = [
        'title' => 'KRS Mahasiswa',
        'krs'   => $this->krs->getKhsLengkap()
                    ->where('krs.id_mahasiswa', $id_mhs)
                    ->where('krs.semester', $smt)
                    ->where('krs.tahun_akademik', $thn)
                    ->findAll()
    ];

    if (empty($data['krs'])) {
        return "Data tidak ditemukan untuk dicetak.";
    }

    return view('krs/print_individu', $data);
}
}