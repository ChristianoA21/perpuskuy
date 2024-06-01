<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/', 'Admin::dashboard');
$routes->get('/admin/daftarBuku', 'Admin::daftarBuku');
$routes->get('/admin/kategoriBuku', 'Admin::kategoriBuku');
$routes->post('/admin/tambahKategori', 'Admin::tambahKategori');
$routes->post('/admin/editKategori/(:segment)', 'Admin::editKategori/$1');
$routes->get('/admin/hapusKategori/(:segment)', 'Admin::hapusKategori/$1');
$routes->post('/admin/tambahBuku', 'Admin::tambahBuku');
$routes->post('/admin/editBuku/(:num)', 'Admin::editBuku/$1');
$routes->get('/admin/hapusBuku/(:num)', 'Admin::hapusBuku/$1');
$routes->get('/admin/petugas', 'Admin::petugas');
$routes->post('/admin/tambahPetugas', 'Admin::tambahPetugas');
$routes->post('/admin/editPetugas/(:num)', 'Admin::editPetugas/$1');
$routes->get('/admin/hapusPetugas/(:num)', 'Admin::hapusPetugas/$1');
$routes->get('/admin/user', 'Admin::user');
$routes->post('/admin/editUser/(:num)', 'Admin::editUser/$1');
$routes->get('/admin/hapusUser/(:num)', 'Admin::hapusUser/$1');
$routes->get('/admin/peminjaman', 'Admin::peminjaman');

$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/daftarBuku', 'Home::daftarBuku');
$routes->get('/logout', 'Home::logout');
$routes->get('/daftarPeminjaman', 'Home::daftarPeminjaman');
$routes->post('/daftarBuku/tambahPeminjaman', 'Home::tambahPeminjaman');
$routes->get('/daftarKoleksi', 'Home::koleksiBuku');
$routes->post('/tambahKoleksi', 'Home::tambahKoleksi');
$routes->get('hapus_koleksi_buku/(:num)', 'Home::hapus_koleksi_buku/$1');
$routes->post('/tambahUlasan', 'Home::tambahUlasan');

$routes->get('/petugas/dashboard', 'Petugas::dashboard');
$routes->get('/petugas/', 'Petugas::dashboard');
$routes->get('/petugas/daftarBuku', 'Petugas::daftarBuku');
$routes->get('/petugas/kategoriBuku', 'Petugas::kategoriBuku');
$routes->post('/petugas/tambahKategori', 'Petugas::tambahKategori');
$routes->post('/petugas/editKategori/(:segment)', 'Petugas::editKategori/$1');
$routes->get('/petugas/hapusKategori/(:segment)', 'Petugas::hapusKategori/$1');
$routes->post('/petugas/tambahBuku', 'Petugas::tambahBuku');
$routes->post('/petugas/editBuku/(:num)', 'Petugas::editBuku/$1');
$routes->get('/petugas/hapusBuku/(:num)', 'Petugas::hapusBuku/$1');
$routes->get('/petugas/peminjaman', 'Petugas::peminjaman');
$routes->get('/petugas/kembalikanBuku/(:num)', 'Petugas::kembalikanBuku/$1');
$routes->post('/petugas/prosesPengembalian/(:num)', 'Petugas::pengembalian/$1');
$routes->get('/petugas/user', 'Petugas::user');
$routes->post('/petugas/editUser/(:num)', 'Petugas::editUser/$1');
// $routes->get('/petugas/hapusUser/(:num)', 'Petugas::hapusUser/$1');
$routes->post('/petugas/printPengembalian/(:num)', 'Petugas::pengembalian/$1');
$routes->get('/petugas/viewStruk/(:num)', 'Petugas::viewStruk/$1');

$routes->post('proses_register', 'Auth\ProsesRegister::proses_register');
$routes->post('proses_login', 'Auth\prosesLogin::proses_login');

$routes->get('admin/dashboard/pdf/generate', 'PdfController::generate');
$routes->get('petugas/dashboard/pdf/generate', 'PdfController::petugas');

