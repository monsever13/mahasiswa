<?php
namespace App\Controllers;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\MatakuliahModel;

class Krs extends BaseController {
    protected $krs, $mhs, $mk;

    public function __construct() {
        $this->krs = new KrsModel();
        $this->mhs = new MahasiswaModel();
        $this->mk  = new MatakuliahModel();
    }

    public function index() {
        $keyword = $this->request->getVar('keyword');
        $data = [
            'title'   => 'Data KRS Mahasiswa',
            // Pastikan method getKrsGrouped ada di KrsModel
            'krs'     => $this->krs->getKrsGrouped($keyword)->paginate(10, 'krs'),
            'pager'   => $this->krs->getKrsGrouped($keyword)->pager,
            'keyword' => $keyword
        ];
        return view('krs/index', $data);
    }

    public function store() {
        $id_mk_list = $this->request->getPost('id_mk');
        $id_mhs     = $this->request->getPost('id_mahasiswa');
        $semester   = $this->request->getPost('semester'); // Dinamis
        $ta         = $this->request->getPost('tahun_akademik'); // Dinamis

        if ($id_mk_list) {
            foreach ($id_mk_list as $id_mk) {
                $this->krs->insert([
                    'id_mahasiswa'   => $id_mhs,
                    'id_matakuliah'  => $id_mk,
                    'tahun_akademik' => $ta,
                    'semester'       => $semester
                ]);
            }
        }
        return redirect()->to('/krs')->with('pesan', 'KRS Berhasil disimpan');
    }

    public function edit($id) {
        $db = \Config\Database::connect();
        $data = [
            'title'      => 'Edit KRS Mahasiswa',
            'krs'        => $this->krs->find($id), // Perbaikan nama property
            'mahasiswa'  => $this->mhs->findAll(),
            'matakuliah' => $this->mk->findAll(),
        ];
        return view('krs/edit', $data);
    }

    public function update($id) {
        $this->krs->update($id, [ // Perbaikan nama property
            'id_mahasiswa'   => $this->request->getPost('id_mahasiswa'),
            'id_matakuliah'  => $this->request->getPost('id_matakuliah'),
            'semester'       => $this->request->getPost('semester'),
            'tahun_akademik' => $this->request->getPost('tahun_akademik'),
        ]);

        return redirect()->to('/krs')->with('pesan', 'Data KRS berhasil diubah');
    }

    public function delete($id) {
        // Jika ingin menghapus semua MK mahasiswa dalam satu semester sekaligus:
        // $this->krs->where('id_mahasiswa', $id)->delete();
        
        // Jika ingin menghapus satu baris saja:
        $this->krs->delete($id);
        return redirect()->to('/krs')->with('pesan', 'Data dihapus');
    }
}