<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\Perpus@index');
Route::post('/login', 'App\Http\Controllers\Perpus@login');
Route::get('/logout', 'App\Http\Controllers\Perpus@logout');

Route::get('/dashboard/siswa', 'App\Http\Controllers\Perpus@dashboardSiswa');
Route::get('/dashboard/petugas', 'App\Http\Controllers\Perpus@dashboardPetugas');
Route::get('/dashboard/admin', 'App\Http\Controllers\Perpus@dashboardAdmin');

Route::get('/register', 'App\Http\Controllers\Perpus@register');
Route::post('/register', 'App\Http\Controllers\Perpus@aksiRegister');

Route::get('/tambah/karyawan', 'App\Http\Controllers\Perpus@tambahKaryawan');
Route::post('/tambah/karyawan', 'App\Http\Controllers\Perpus@aksiTambahKaryawan');