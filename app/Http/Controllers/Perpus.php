<?php

namespace App\Http\Controllers;

use App\Models\UserQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $conditionsSiswa = array('IDUser' => $user->IDUser);
                $siswa = $query->pull('siswa', $conditionsSiswa);
                
                if ($siswa) {
                    session(['IDSiswa' => $siswa->IDSiswa]);
                }
                
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
            $data['peminjaman'] = $query->tampilPeminjaman();
            return view('dashboardkaryawan', $data);
        } else {
            return redirect()->intended('/');
        }
    }

    public function dashboardAdmin()
    {
        if (session('Username')) {
            return view('dashboardadmin');
        } else {
            return redirect()->intended('/');
        }
    }

    // ================= ADMIN VIEWS =================

    public function adminKaryawan()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['karyawan'] = $query->tampilKaryawan();
            return view('admin.karyawan', $data);
        }
        return redirect('/');
    }

    public function adminBuku()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['buku'] = $query->tampil('buku');
            return view('admin.buku', $data);
        }
        return redirect('/');
    }

    public function adminPeminjaman()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['peminjaman'] = $query->tampilPeminjaman();
            return view('admin.peminjaman', $data);
        }
        return redirect('/');
    }

    public function adminDenda()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['denda'] = $query->tampil('denda'); 
            return view('admin.denda', $data);
        }
        return redirect('/');
    }

    // ================= AUTH & KARYAWAN =================

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
        $file = $request->file('Foto');
        $nama_foto="";

        if ($file) {
            $nama_foto = time() . "_" . $file->getClientOriginalName(); 
            $tujuan_upload = 'assets/img';
            $file->move($tujuan_upload, $nama_foto);
        }

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
            'IDUser' => $user->IDUser,
            'Foto' => $nama_foto
        );
        $query->tambah('karyawan', $dataKaryawan);
        
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

    // ================= BUKU =================

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

    public function editBuku($id)
    {
        $query = new UserQuery;
        $conditions = array('IDBuku' => $id);
        $buku = $query->pull('buku', $conditions);

        return view('editbuku', ['buku' => $buku]);
    }

        public function aksiEditBuku(Request $request, $id)
    {
        $query = new UserQuery;
        $conditions = array('IDBuku' => $id);

        $bukuLama = $query->pull('buku', $conditions);

        $dataBuku = array(
            'JudulBuku' => $request->input('JudulBuku'),
            'KategoriBuku' => $request->input('KategoriBuku'),
            'JumlahHal' => $request->input('JumlahHal'),
            'Stok' => $request->input('Stok')
        );

        if (session('Role') == 'Admin') {
            $dataBuku['Bahasa'] = $request->input('Bahasa');
            $dataBuku['Cover'] = $request->input('Cover');
            $dataBuku['TahunTerbit'] = $request->input('TahunTerbit');
            $dataBuku['ISBN'] = $request->input('ISBN');
            $dataBuku['NamaPenulis'] = $request->input('NamaPenulis');
            $dataBuku['IDPenerbit'] = $request->input('IDPenerbit');
            $dataBuku['LokasiRak'] = $request->input('LokasiRak');
        } else {
            $dataBuku['Bahasa'] = $bukuLama->Bahasa;
            $dataBuku['Cover'] = $bukuLama->Cover;
            $dataBuku['TahunTerbit'] = $bukuLama->TahunTerbit;
            $dataBuku['ISBN'] = $bukuLama->ISBN;
            $dataBuku['NamaPenulis'] = $bukuLama->NamaPenulis;
            $dataBuku['IDPenerbit'] = $bukuLama->IDPenerbit;
            $dataBuku['LokasiRak'] = $bukuLama->LokasiRak;
        }

        $query->updateData('buku', $conditions, $dataBuku);

        if (session('Role') == 'Admin') {
            return redirect()->intended('/admin/buku');
        } else {
            return redirect()->intended('/karyawan/buku');
        }
    }

    public function hapusBuku($id)
    {
        $query = new UserQuery;
        $query->hapus('buku', 'IDBuku', $id); 
        return redirect()->intended('/dashboard/admin');
    }

    // ================= TRANSAKSI =================

    public function pinjamBuku($id)
    {
        if (!session('IDSiswa')) {
            return redirect()->intended('/');
        }

        $query = new UserQuery;
        $buku = $query->pull('buku', ['IDBuku' => $id]);
        
        if ($buku->Stok <= 0) {
            return redirect()->intended('/dashboard/siswa');
        }

        $dataPeminjaman = array(
            'IDSiswa' => session('IDSiswa'),
            'IDKaryawan' => 1, 
            'TglPeminjaman' => date('Y-m-d H:i:s'),
            'Status' => 'Belum'
        );
        
        $IDPeminjamanBaru = $query->tambahDapatId('peminjaman', $dataPeminjaman);

        $dataDetail = array(
            'IDPeminjaman' => $IDPeminjamanBaru,
            'IDBuku' => $id,
            'Jumlah' => 1
        );
        $query->tambah('detailpeminjaman', $dataDetail);

        $query->kurangiStok($id);

        return redirect()->intended('/dashboard/siswa');
    }

    public function formKembalikan($id)
    {
        $query = new UserQuery;
        $data['peminjaman'] = $query->pull('peminjaman', ['IDPeminjaman' => $id]);
        return view('kembalikan', $data);
    }

    public function aksiKembalikan(Request $request, $id)
    {
        $query = new UserQuery;
        
        $dataKembali = array(
            'IDPeminjaman' => $id,
            'TglPengembalian' => date('Y-m-d H:i:s'),
            'KondisiBuku' => $request->input('KondisiBuku')
        );
        $query->tambah('pengembalian', $dataKembali);
        $query->updateData('peminjaman', ['IDPeminjaman' => $id], ['Status' => 'Sudah']);

        $detail = $query->pull('detailpeminjaman', ['IDPeminjaman' => $id]);
        $query->tambahStok($detail->IDBuku);

        return redirect()->intended('/dashboard/admin'); 
    }

    public function formDenda($id)
    {
        return view('denda', ['IDPeminjaman' => $id]);
    }

    public function aksiDenda(Request $request, $id)
    {
        $dataDenda = array(
            'IDPeminjaman' => $id,
            'AlasanDenda' => $request->input('AlasanDenda'),
            'JumlahDenda' => $request->input('JumlahDenda'),
            'StatusBayar' => 'Belum Lunas'
        );
        
        $query = new UserQuery;
        $query->tambah('denda', $dataDenda);

        return redirect()->intended('/dashboard/admin');
    }

        public function karyawanBuku()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['buku'] = $query->tampil('buku');
            return view('karyawan.buku', $data);
        }
        return redirect('/');
    }

    public function karyawanPeminjaman()
    {
        if (session('Username')) {
            $query = new UserQuery;
            $data['peminjaman'] = $query->tampilPeminjaman();
            return view('karyawan.peminjaman', $data);
        }
        return redirect('/');
    }
    
        public function dendaAdmin()
    {
        if (session('Role') != 'Admin') {
            return redirect('/');
        }
        $query = new UserQuery;
        $data['denda'] = $query->tampilDenda(); // Using the new JOIN
        return view('admin.denda', $data);
    }

    public function karyawanDenda()
    {
        if (session('Role') != 'Petugas' && session('Role') != 'Admin') {
            return redirect('/');
        }
        $query = new UserQuery;
        $data['denda'] = $query->tampilDenda(); // Using the new JOIN
        return view('karyawan.denda', $data);
    }
}