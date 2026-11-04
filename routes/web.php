<?php

use Illuminate\Support\Facades\Route;

//  Login Logout
Route::get('/', 'App\Http\Controllers\Perpus@index');
Route::post('/login', 'App\Http\Controllers\Perpus@login');
Route::get('/logout', 'App\Http\Controllers\Perpus@logout');

//  Dashboard
Route::get('/dashboard/siswa', 'App\Http\Controllers\Perpus@dashboardSiswa');
Route::get('/dashboard/petugas', 'App\Http\Controllers\Perpus@dashboardKaryawan');
Route::get('/dashboard/admin', 'App\Http\Controllers\Perpus@dashboardAdmin');

//  Register
Route::get('/register', 'App\Http\Controllers\Perpus@register');
Route::post('/register', 'App\Http\Controllers\Perpus@aksiRegister');

//  Aksi Karyawan
Route::get('/tambah/karyawan', 'App\Http\Controllers\Perpus@tambahKaryawan');
Route::post('/tambah/karyawan', 'App\Http\Controllers\Perpus@aksiTambahKaryawan');

Route::get('/edit/karyawan/{id}', 'App\Http\Controllers\Perpus@editKaryawan');
Route::post('/edit/karyawan/{id}', 'App\Http\Controllers\Perpus@aksiEditKaryawan');
Route::get('/hapus/karyawan/{id}', 'App\Http\Controllers\Perpus@hapusKaryawan');

//  AKsi Buku
Route::get('/tambah/buku', 'App\Http\Controllers\Perpus@tambahBuku');
Route::post('/tambah/buku', 'App\Http\Controllers\Perpus@aksiTambahBuku');

Route::get('/edit/buku/{id}', 'App\Http\Controllers\Perpus@editBuku');
Route::post('/edit/buku/{id}', 'App\Http\Controllers\Perpus@aksiEditBuku');
Route::get('/hapus/buku/{id}', 'App\Http\Controllers\Perpus@hapusBuku');

Route::get('/pinjam/{id}', 'App\Http\Controllers\Perpus@pinjamBuku');

Route::get('/kembalikan/{id}', 'App\Http\Controllers\Perpus@formKembalikan');
Route::post('/kembalikan/{id}', 'App\Http\Controllers\Perpus@aksiKembalikan');


//  Denda
Route::get('/denda/{id}', 'App\Http\Controllers\Perpus@formDenda');
Route::post('/denda/{id}', 'App\Http\Controllers\Perpus@aksiDenda');


// Admin Views
Route::get('/admin/karyawan', 'App\Http\Controllers\Perpus@adminKaryawan');
Route::get('/admin/buku', 'App\Http\Controllers\Perpus@adminBuku');
Route::get('/admin/peminjaman', 'App\Http\Controllers\Perpus@adminPeminjaman');
Route::get('/admin/denda', 'App\Http\Controllers\Perpus@adminDenda');

// Karyawan Views
Route::get('/karyawan/buku', 'App\Http\Controllers\Perpus@karyawanBuku');
Route::get('/karyawan/peminjaman', 'App\Http\Controllers\Perpus@karyawanPeminjaman');