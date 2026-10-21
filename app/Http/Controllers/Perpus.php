<?php

namespace App\Http\Controllers;

use App\Models\UserQuery;
use Illuminate\Http\Request;

class Perpus extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ]);

        $username = $request->input('Username');
        $password = $request->input('Password');

        $conditions = array(
            'Username' => $username,
            'Password' => $password
        );

        $query = new UserQuery;
        $user = $query->pull('users', $conditions);

        if ($user) {
            session(['Username' => $user->Username]);
            session(['Role' => $user->Role]);

            if ($user->Role == 'Admin') {
                return redirect()->intended('/dashboard/admin');
            } else if ($user->Role == 'Petugas') {
                return redirect()->intended('/dashboard/petugas');
            } else {
                return redirect()->intended('/dashboard/siswa');
            }
        } else {
            return redirect()->intended('/');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->intended('/');
    }

    public function dashboardSiswa()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['buku'] = $query->tampil('buku'); 
            return view('dashboardsiswa', $data);   
        } else {
            return redirect()->intended('/');
        }
    }

          public function dashboardPetugas()
    {
        if (session('Username')) {
            return view('dashboardpetugas');
        } else {
            return redirect()->intended('/');
        }
    }

    public function dashboardAdmin()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['karyawan'] = $query->tampil('karyawan');
            return view('dashboardadmin', $data);
        } else {
            return redirect()->intended('/');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function aksiRegister(Request $request)
    {
        $request->validate([
            'Username' => 'required|unique:users,Username',
            'Password' => 'required',
            'EmailUser' => 'required',
            'Gender' => 'required'
        ]);

        $username = $request->input('Username');
        $password = $request->input('Password');
        $email = $request->input('EmailUser');
        $gender = $request->input('Gender');
        
        $nama = $request->input('NamaSiswa');
        $rombel = $request->input('Rombel');
        $nis = $request->input('NIS');

        $dataUser = array(
            'Username' => $username,
            'Password' => $password,
            'Role' => 'Siswa',
            'EmailUser' => $email,
            'Gender' => $gender
        );
        $query = new UserQuery;
        $query->tambah('users', $dataUser);

        $conditions = array('Username' => $username);
        $user = $query->pull('users', $conditions);

        $dataSiswa = array(
            'NamaSiswa' => $nama,
            'Rombel' => $rombel,
            'NIS' => $nis,
            'IDUser' => $user->IDUser
        );
        $query->tambah('siswa', $dataSiswa);

        return redirect()->intended('/');
    }
    
        public function tambahKaryawan()
    {
        $query = new UserQuery;
        $data['jabatan'] = $query->tampil('jabatan'); 
        return view('tambahkaryawan', $data);
    }

    public function aksiTambahKaryawan(Request $request)
    {
        $username = $request->input('Username');
        $password = $request->input('Password');
        $email = $request->input('EmailUser');
        $gender = $request->input('Gender');
        $nama = $request->input('NamaKaryawan');
        $notelp = $request->input('NoTelp_K');
        $sesi = $request->input('SesiKerja');
        $jabatan = $request->input('Jabatan'); 

        $dataUser = array(
            'Username' => $username,
            'Password' => $password,
            'Role' => 'Petugas',
            'EmailUser' => $email,
            'Gender' => $gender
        );
        $query = new UserQuery;
        $query->tambah('users', $dataUser);

        $conditions = array('Username' => $username);
        $user = $query->pull('users', $conditions);

        $dataKaryawan = array(
            'NamaKaryawan' => $nama,
            'NoTelp_K' => $notelp,
            'Jabatan' => $jabatan, 
            'SesiKerja' => $sesi,
            'IDUser' => $user->IDUser
        );
        $query->tambah('karyawan', $dataKaryawan);
        
        return redirect()->intended('/dashboard/admin');
    }
}