<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Perpus@index');
Route::post('/login', 'App\Http\Controllers\Perpus@login');
Route::get('/logout', 'App\Http\Controllers\Perpus@logout');

Route::get('/dashboard/siswa', 'App\Http\Controllers\Perpus@dashboardSiswa');
Route::get('/dashboard/petugas', 'App\Http\Controllers\Perpus@dashboardKaryawan');
Route::get('/dashboard/admin', 'App\Http\Controllers\Perpus@dashboardAdmin');

Route::get('/register', 'App\Http\Controllers\Perpus@register');
Route::post('/register', 'App\Http\Controllers\Perpus@aksiRegister');

Route::get('/tambah/karyawan', 'App\Http\Controllers\Perpus@tambahKaryawan');
Route::post('/tambah/karyawan', 'App\Http\Controllers\Perpus@aksiTambahKaryawan');

Route::get('/tambah/buku', 'App\Http\Controllers\Perpus@tambahBuku');
Route::post('/tambah/buku', 'App\Http\Controllers\Perpus@aksiTambahBuku');


//  Aksi Karyawan
Route::get('/edit/karyawan/{id}', 'App\Http\Controllers\Perpus@editKaryawan');
Route::post('/edit/karyawan/{id}', 'App\Http\Controllers\Perpus@aksiEditKaryawan');
Route::get('/hapus/karyawan/{id}', 'App\Http\Controllers\Perpus@hapusKaryawan');

//  AKsi Buku
Route::get('/edit/buku/{id}', 'App\Http\Controllers\Perpus@editBuku');
Route::post('/edit/buku/{id}', 'App\Http\Controllers\Perpus@aksiEditBuku');
Route::get('/hapus/buku/{id}', 'App\Http\Controllers\Perpus@hapusBuku');