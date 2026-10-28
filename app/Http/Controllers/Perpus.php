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

          public function dashboardKaryawan()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['buku'] = $query->tampil('buku');
            return view('dashboardkaryawan', $data);
        } else {
            return redirect()->intended('/');
        }
    }

    public function dashboardAdmin()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['karyawan'] = $query->tampilKaryawan(); 
            $data['buku'] = $query->tampil('buku');         
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

        public function tambahBuku()
    {
        return view('tambahbuku');
    }

    public function aksiTambahBuku(Request $request)
    {
        $judul = $request->input('JudulBuku');
        $kategori = $request->input('KategoriBuku');
        $bahasa = $request->input('Bahasa');
        $cover = $request->input('Cover');
        $stok = $request->input('Stok');
        $jumlahhal = $request->input('JumlahHal');
        $tahun = $request->input('TahunTerbit');
        $isbn = $request->input('ISBN');
        $penulis = $request->input('NamaPenulis');
        $penerbit = $request->input('IDPenerbit');
        $rak = $request->input('LokasiRak');

        $dataBuku = array(
            'JudulBuku' => $judul,
            'KategoriBuku' => $kategori,
            'Bahasa' => $bahasa,
            'Cover' => $cover,
            'Stok' => $stok,
            'JumlahHal' => $jumlahhal,
            'TahunTerbit' => $tahun,
            'ISBN' => $isbn,
            'NamaPenulis' => $penulis,
            'IDPenerbit' => $penerbit,
            'LokasiRak' => $rak
        );

        $query = new UserQuery;
        $query->tambah('buku', $dataBuku);
        
        return redirect()->intended('/dashboard/admin');
    }
    

    public function editKaryawan($id)
    {
        $query = new UserQuery;
        
        $conditions = array('IDKaryawan' => $id);
        $karyawan = $query->pull('karyawan', $conditions);
        
        $userConditions = array('IDUser' => $karyawan->IDUser);
        $user = $query->pull('users', $userConditions);

        return view('editkaryawan', ['karyawan' => $karyawan, 'user' => $user]);
    }

    public function aksiEditKaryawan(Request $request, $id)
    {
        $request->validate([
            'Username' => 'required',
            'EmailUser' => 'required',
            'NamaKaryawan' => 'required',
            'NoTelp_K' => 'required',
            'SesiKerja' => 'required',
            'Jabatan' => 'required'
        ]);

        $query = new UserQuery;

        $dataKaryawan = array(
            'NamaKaryawan' => $request->input('NamaKaryawan'),
            'NoTelp_K' => $request->input('NoTelp_K'),
            'SesiKerja' => $request->input('SesiKerja'),
            'Jabatan' => $request->input('Jabatan')
        );
        $conditionsKaryawan = array('IDKaryawan' => $id);
        $query->updateData('karyawan', $conditionsKaryawan, $dataKaryawan);

        $currentKaryawan = $query->pull('karyawan', $conditionsKaryawan);
        $dataUser = array(
            'Username' => $request->input('Username'),
            'EmailUser' => $request->input('EmailUser')
        );
        $conditionsUser = array('IDUser' => $currentKaryawan->IDUser);
        $query->updateData('users', $conditionsUser, $dataUser);

        return redirect()->intended('/dashboard/admin');
    }

    public function hapusKaryawan($id)
    {
        $query = new UserQuery;
        
        $conditions = array('IDKaryawan' => $id);
        $karyawan = $query->pull('karyawan', $conditions);

        $query->hapus('karyawan', 'IDKaryawan', $id);

        $query->hapus('users', 'IDUser', $karyawan->IDUser);

        return redirect()->intended('/dashboard/admin');
    }


    public function editBuku($id)
    {
        $query = new UserQuery;
        $conditions = array('IDBuku' => $id);
        $buku = $query->pull('buku', $conditions);

        return view('editbuku', ['buku' => $buku]);
    }

    public function aksiEditBuku(Request $request, $id)
    {
        $request->validate([
            'JudulBuku' => 'required',
            'KategoriBuku' => 'required',
            'Stok' => 'required'
        ]);

        $dataBuku = array(
            'JudulBuku' => $request->input('JudulBuku'),
            'KategoriBuku' => $request->input('KategoriBuku'),
            'Bahasa' => $request->input('Bahasa'),
            'Cover' => $request->input('Cover'),
            'Stok' => $request->input('Stok'),
            'JumlahHal' => $request->input('JumlahHal'),
            'TahunTerbit' => $request->input('TahunTerbit'),
            'ISBN' => $request->input('ISBN'),
            'NamaPenulis' => $request->input('NamaPenulis'),
            'IDPenerbit' => $request->input('IDPenerbit'),
            'LokasiRak' => $request->input('LokasiRak')
        );

        $query = new UserQuery;
        $conditions = array('IDBuku' => $id);
        $query->updateData('buku', $conditions, $dataBuku);

        return redirect()->intended('/dashboard/admin');
    }

    public function hapusBuku($id)
    {
        $query = new UserQuery;
        $query->hapus('buku', 'IDBuku', $id); 
        return redirect()->intended('/dashboard/admin');
    }
}    
