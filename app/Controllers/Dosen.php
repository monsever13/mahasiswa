<?php

namespace App\Controllers;

use App\Models\DosenModel;

class Dosen extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
    }

   public function index()
{
    $dosenModel = new \App\Models\DosenModel();
    
    // Ambil keyword pencarian dan jumlah data per halaman
    $katakunci = $this->request->getGet('search');
    $perPage = $this->request->getGet('perPage') ?? 10;

    if ($katakunci) {
        $dosenModel->like('nama_dosen', $katakunci)
                   ->orLike('nidn', $katakunci)
                   ->orLike('spesialisasi', $katakunci);
    }

    $data = [
        'title' => 'Daftar Dosen Pengajar',
        // Menggunakan grup 'dosen' untuk pager
        'dosen' => $dosenModel->paginate($perPage, 'dosen'),
        'pager' => $dosenModel->pager,
        'search' => $katakunci,
        'perPage' => $perPage,
        'page' => $this->request->getVar('page_dosen') ?? 1
    ];

    return view('dosen/index', $data);
}

    public function create()
    {
        return view('dosen/create');
    }

    public function store()
    {
        $this->dosenModel->save([
            'nidn'         => $this->request->getPost('nidn'),
            'nama_dosen'   => $this->request->getPost('nama_dosen'),
            'email'        => $this->request->getPost('email'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
        ]);

        return redirect()->to('/dosen')->with('pesan', 'Data dosen berhasil ditambahkan.');
    }

    public function edit($id)
{
    $data = [
        'title' => 'Edit Data Dosen',
        'dosen' => $this->dosenModel->find($id)
    ];

    if (empty($data['dosen'])) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data dosen tidak ditemukan');
    }

    return view('dosen/edit', $data);
}

    public function update($id)
    {
        $this->dosenModel->update($id, [
            'nidn'         => $this->request->getPost('nidn'),
            'nama_dosen'   => $this->request->getPost('nama_dosen'),
            'email'        => $this->request->getPost('email'),
            'spesialisasi' => $this->request->getPost('spesialisasi'),
        ]);

        return redirect()->to('/dosen')->with('pesan', 'Data dosen berhasil diubah.');
    }

    public function delete($id)
    {
        $this->dosenModel->delete($id);
        return redirect()->to('/dosen')->with('pesan', 'Data dosen berhasil dihapus.');
    }
}