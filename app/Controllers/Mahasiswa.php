<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Controller;

class Mahasiswa extends BaseController
{
    protected $mhsModel;

    public function __construct()
    {
        // Memanggil model mahasiswa agar bisa digunakan di semua function
        $this->mhsModel = new MahasiswaModel();
    }

    // 1. Menampilkan semua data
    public function index()
{
    $mhsModel = new \App\Models\MahasiswaModel();
    
    // Ambil keyword pencarian
    $katakunci = $this->request->getGet('search');
    
    // Ambil jumlah data per halaman (default 10)
    $perPage = $this->request->getGet('perPage') ?? 10;

    if ($katakunci) {
        $mhsModel->like('nama', $katakunci)->orLike('nim', $katakunci);
    }

    $data = [
        'title'     => 'Daftar Mahasiswa',
        // Menggunakan paginate() bukannya findAll()
        'mahasiswa' => $mhsModel->paginate($perPage, 'mahasiswa'),
        'pager'     => $mhsModel->pager,
        'search'    => $katakunci,
        'perPage'   => $perPage,
        'page'      => $this->request->getVar('page_mahasiswa') ?? 1
    ];

    return view('mahasiswa/index', $data);
}

    // 2. Menampilkan form tambah data
    public function create()
    {
        return view('mahasiswa/create');
    }

    // 3. Menyimpan data baru ke database
    public function store()
    {
        $this->mhsModel->save([
            'nim'     => $this->request->getPost('nim'),
            'nama'    => $this->request->getPost('nama'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email'   => $this->request->getPost('email'),
        ]);

        return redirect()->to('/mahasiswa');
    }

    // 4. Menampilkan form edit data
    public function edit($id)
    {
        $data = [
            'mhs' => $this->mhsModel->find($id)
        ];

        return view('mahasiswa/edit', $data);
    }

    // 5. Memperbarui data lama
    public function update($id)
    {
        $this->mhsModel->update($id, [
            'nim'     => $this->request->getPost('nim'),
            'nama'    => $this->request->getPost('nama'),
            'jurusan' => $this->request->getPost('jurusan'),
            'email'   => $this->request->getPost('email'),
        ]);

        return redirect()->to('/mahasiswa');
    }

    // 6. Menghapus data
    public function delete($id)
    {
        $this->mhsModel->delete($id);
        return redirect()->to('/mahasiswa');
    }
}