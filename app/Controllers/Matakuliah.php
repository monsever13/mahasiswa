<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\DosenModel;

class Matakuliah extends BaseController
{
    protected $mkModel, $dosenModel;

    public function __construct() {
        $this->mkModel = new MatakuliahModel();
        $this->dosenModel = new DosenModel();
    }

    public function index()
{
    $keyword = $this->request->getVar('keyword');
    
    if ($keyword) {
        $query = $this->mkModel->search($keyword);
    } else {
        $query = $this->mkModel->select('data_matakuliah.*, data_dosen.nama_dosen')
                               ->join('data_dosen', 'data_dosen.id = data_matakuliah.id_dosen');
    }

    $data = [
        'title'      => 'Daftar Mata Kuliah',
        // '10' adalah jumlah data per halaman, 'matakuliah' adalah grup pagination
        'matakuliah' => $query->paginate(10, 'matakuliah'),
        'pager'      => $this->mkModel->pager,
        'keyword'    => $keyword
    ];

    return view('matakuliah/index', $data);
}

    public function create() {
        return view('matakuliah/create', [
            'title' => 'Tambah Mata Kuliah',
            'dosen' => $this->dosenModel->findAll()
        ]);
    }

    public function store() {
        $this->mkModel->save($this->request->getPost());
        return redirect()->to('/matakuliah')->with('pesan', 'Data berhasil disimpan.');
    }

    public function edit($id) {
        return view('matakuliah/edit', [
            'title' => 'Edit Mata Kuliah',
            'mk'    => $this->mkModel->find($id),
            'dosen' => $this->dosenModel->findAll()
        ]);
    }

    public function update($id) {
        $this->mkModel->update($id, $this->request->getPost());
        return redirect()->to('/matakuliah')->with('pesan', 'Data berhasil diubah.');
    }

   public function delete($id) {
    $this->mkModel->delete($id);
    return redirect()->to('/matakuliah')->with('pesan', 'Data Berhasil Dihapus');
}
}