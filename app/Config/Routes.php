<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'Home::index');

$routes->group('absensi', function($routes) {
    // Routing dasar CRUD
    $routes->get('/', 'Absensi::index');
    $routes->get('create', 'Absensi::create');
    $routes->post('store', 'Absensi::store');
    $routes->post('storeBatch', 'Absensi::storeBatch'); // DIBALIKKAN ke nama asli
    $routes->get('edit/(:num)', 'Absensi::edit/$1');
    $routes->post('update/(:num)', 'Absensi::update/$1');
    $routes->get('delete/(:num)', 'Absensi::delete/$1');
    $routes->get('detail/(:num)', 'Absensi::detail/$1');
    
    // ✅ PERBAIKAN: Print routes - tambahkan kedua versi
    $routes->get('print', 'Absensi::print');  // Untuk print semua data
    $routes->get('print/(:num)', 'Absensi::printSingle/$1'); // Untuk print data spesifik
    
    // Batch processing
    $routes->get('create_batch/(:num)/(:num)', 'Absensi::createBatch/$1/$2');
    
    // Cart system - KEMBALIKAN ke nama asli sesuai controller
    $routes->post('add_to_cart', 'Absensi::add_to_cart');
    $routes->post('update_checklist', 'Absensi::update_checklist');
    $routes->get('remove_cart/(:num)', 'Absensi::remove_cart/$1');
    $routes->get('simpan_permanen', 'Absensi::simpan_permanen');
    $routes->get('clear_cart', 'Absensi::clearCart');
    
    // Kelas management - TAMBAHKAN yang hilang
    $routes->get('kelas/(:num)/(:num)/(:any)', 'Absensi::detailKelas/$1/$2/$3');
    $routes->get('print_kelas/(:num)/(:num)/(:any)', 'Absensi::print_kelas/$1/$2/$3');
    $routes->get('delete_kelas/(:num)/(:num)/(:any)', 'Absensi::delete_kelas/$1/$2/$3');
    
    // Export/Report
    $routes->get('export/(:num)/(:num)', 'Absensi::exportExcel/$1/$2');
    $routes->get('export_all', 'Absensi::exportAllExcel');
});

// Mahasiswa Routes
$routes->group('mahasiswa', function($routes) {
    $routes->get('/', 'Mahasiswa::index');
    $routes->get('create', 'Mahasiswa::create');
    $routes->post('store', 'Mahasiswa::store');
    $routes->get('edit/(:num)', 'Mahasiswa::edit/$1');
    $routes->post('update/(:num)', 'Mahasiswa::update/$1');
    $routes->get('delete/(:num)', 'Mahasiswa::delete/$1');
});

// Dosen Routes
$routes->group('dosen', function($routes) {
    $routes->get('/', 'Dosen::index');
    $routes->get('create', 'Dosen::create');
    $routes->post('store', 'Dosen::store');
    $routes->get('edit/(:num)', 'Dosen::edit/$1');
    $routes->post('update/(:num)', 'Dosen::update/$1');
    $routes->get('delete/(:num)', 'Dosen::delete/$1');
});

// Matakuliah Routes
$routes->group('matakuliah', function($routes) {
    $routes->get('/', 'Matakuliah::index');
    $routes->get('create', 'Matakuliah::create');
    $routes->post('store', 'Matakuliah::store');
    $routes->get('edit/(:num)', 'Matakuliah::edit/$1');
    $routes->post('update/(:num)', 'Matakuliah::update/$1');
    $routes->get('delete/(:num)', 'Matakuliah::delete/$1');
});

// KRS Routes
$routes->group('krs', function($routes) {
    $routes->get('/', 'Krs::index');
    $routes->get('create', 'Krs::create');
    $routes->post('store', 'Krs::store');
    $routes->get('edit/(:num)', 'Krs::edit/$1');
    $routes->post('add_item', 'Krs::add_item');
    $routes->post('update_info', 'Krs::update_info');
    $routes->delete('delete/(:num)', 'Krs::delete/$1');
    $routes->get('print_all', 'Krs::print_all');
    $routes->get('print_individu/(:num)', 'Krs::print_individu/$1');
});

// KHS Routes
$routes->group('khs', function($routes) {
    $routes->get('/', 'Khs::index');
    $routes->get('detail/(:num)', 'Khs::detail/$1');
    $routes->post('update/(:num)', 'Khs::update/$1');
    $routes->get('print/(:num)', 'Khs::print/$1');
    $routes->delete('delete/(:num)', 'Khs::delete/$1');
});