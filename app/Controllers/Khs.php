<?php
namespace App\Controllers;
use App\Models\KhsModel;

class Khs extends BaseController {
    protected $khsModel;

    public function __construct() {
        $this->khsModel = new KhsModel();
    }

    // Menampilkan 1 baris per mahasiswa (Grouped)
    public function index() {
        $keyword = $this->request->getVar('keyword');
        $data = [
            'title' => 'Data KHS Mahasiswa',
            'khs'   => $this->khsModel->getKhsGrouped($keyword)->paginate(10, 'khs'),
            'pager' => $this->khsModel->getKhsGrouped($keyword)->pager,
            'keyword' => $keyword
        ];
        return view('khs/index', $data);
    }

    // FUNGSI YANG TADI HILANG (404)
    public function detail($id_mahasiswa) {
        $data = [
            'title'      => 'Input Nilai Mahasiswa',
            'mahasiswa'  => $this->khsModel->getDataKhs()->where('krs.id_mahasiswa', $id_mahasiswa)->first(),
            'matakuliah' => $this->khsModel->getDataKhs()->where('krs.id_mahasiswa', $id_mahasiswa)->findAll()
        ];

        if (!$data['mahasiswa']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('khs/detail', $data);
    }

    public function update($id) {
        $this->khsModel->update($id, ['nilai_angka' => $this->request->getPost('nilai_angka')]);
        return redirect()->back()->with('pesan', 'Nilai berhasil disimpan');
    }

    public function print($id_mahasiswa) {
        $data['result'] = $this->khsModel->getDataKhs()->where('krs.id_mahasiswa', $id_mahasiswa)->findAll();
        return view('khs/print', $data);
    }
    public function update_info($id_mahasiswa) {
    // Update semua baris KRS mahasiswa tersebut untuk semester/tahun yang sama
    $this->khsModel->where('id_mahasiswa', $id_mahasiswa)
                   ->set([
                       'semester' => $this->request->getPost('semester'),
                       'tahun_akademik' => $this->request->getPost('tahun_akademik')
                   ])
                   ->update();

    return redirect()->back()->with('pesan', 'Info Akademik Berhasil Diperbarui');
}
public function delete($id_mahasiswa)
{
    // Mengambil semester dan tahun dari filter atau data terbaru jika perlu spesifik
    // Namun umumnya kita hapus berdasarkan id_mahasiswa yang sedang ditampilkan
    $this->khsModel->where('id_mahasiswa', $id_mahasiswa)->delete();

    return redirect()->to('/khs')->with('pesan', 'Data KHS mahasiswa berhasil dihapus.');
}
}