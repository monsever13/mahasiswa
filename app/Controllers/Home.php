<?php
namespace App\Controllers;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MatakuliahModel;


class Home extends BaseController {
    public function index() {
        $mhs = new MahasiswaModel();
        $dsn = new DosenModel();
        $mk  = new MatakuliahModel();
        

        $data = [
            'title'     => 'Dashboard Admin',
            'total_mhs' => $mhs->countAllResults(),
            'total_dsn' => $dsn->countAllResults(),
            'total_mk'  => $mk->countAllResults(),
           
        ];
        return view('home_view', $data);
    }
}