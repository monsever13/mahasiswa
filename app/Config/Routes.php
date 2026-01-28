<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. Halaman Utama
$routes->get('/', 'Home::index');

// 2. Rute Manajemen Mahasiswa
$routes->group('mahasiswa', function($routes) {
    $routes->get('/', 'Mahasiswa::index');
    $routes->get('create', 'Mahasiswa::create');
    $routes->post('store', 'Mahasiswa::store');
    $routes->get('edit/(:num)', 'Mahasiswa::edit/$1');
    $routes->post('update/(:num)', 'Mahasiswa::update/$1');
    $routes->get('delete/(:num)', 'Mahasiswa::delete/$1');
});

// 3. Rute Manajemen Dosen
$routes->group('dosen', function($routes) {
    $routes->get('/', 'Dosen::index');
    $routes->get('create', 'Dosen::create');
    $routes->post('store', 'Dosen::store');
    $routes->get('edit/(:num)', 'Dosen::edit/$1');
    $routes->post('update/(:num)', 'Dosen::update/$1');
    $routes->get('delete/(:num)', 'Dosen::delete/$1');
});

// 4. Rute Manajemen Mata Kuliah
$routes->group('matakuliah', function($routes) {
    $routes->get('/', 'Matakuliah::index');
    $routes->get('create', 'Matakuliah::create');
    $routes->post('store', 'Matakuliah::store');
    $routes->get('edit/(:num)', 'Matakuliah::edit/$1');
    $routes->post('update/(:num)', 'Matakuliah::update/$1');
    $routes->get('delete/(:num)', 'Matakuliah::delete/$1');
});

$routes->group('krs', function($routes) {
    $routes->get('/', 'Krs::index');              // URL: /krs
    $routes->get('create', 'Krs::create');        // URL: /krs/create
    $routes->post('store', 'Krs::store');         // URL: /krs/store
    $routes->get('edit/(:num)', 'Krs::edit/$1');  // URL: /krs/edit/ID
    
    // PERBAIKAN DI SINI:
    $routes->post('add_item', 'Krs::add_item');     // URL: /krs/add_item
    $routes->post('update_info', 'Krs::update_info'); // URL: /krs/update_info
    $routes->delete('delete/(:num)', 'Krs::delete/$1'); // URL: /krs/delete/ID
    $routes->get('print_all', 'Krs::print_all');
    $routes->get('print_individu/(:num)', 'Krs::print_individu/$1');
});

// 6. Rute KHS
$routes->group('khs', function($routes) {
    $routes->get('/', 'Khs::index');
    $routes->get('detail/(:num)', 'Khs::detail/$1');
    $routes->post('update/(:num)', 'Khs::update/$1');
    $routes->get('print/(:num)', 'Khs::print/$1');
    $routes->delete('delete/(:num)', 'Khs::delete/$1');
});

// 7. Rute Laporan Absensi
$routes->group('absensi', function($routes) {
    $routes->get('/', 'Absensi::index');
    $routes->get('create', 'Absensi::create');
    $routes->post('store', 'Absensi::store');
    $routes->get('edit/(:num)', 'Absensi::edit/$1');
    $routes->post('update/(:num)', 'Absensi::update/$1');
    $routes->get('print/(:num)', 'Absensi::print/$1');
});