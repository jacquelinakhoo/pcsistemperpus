<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserQuery extends Model
{
    public function pull($tableName, $conditions)
    {
        return DB::table($tableName)->where($conditions)->first();
    }

    public function tampil($tableName)
    {
        return DB::table($tableName)->get();
    }

    public function tambah($tableName, $data)
    {
        return DB::table($tableName)->insert($data);
    }

    public function updateData($tableName, $conditions, $data)
    {
        return DB::table($tableName)->where($conditions)->update($data);
    }

    public function tampilKaryawan()
    {
        return DB::table('karyawan')
                 ->join('users', 'karyawan.IDUser', '=', 'users.IDUser')
                 ->select('karyawan.*', 'users.Username')
                 ->get();
    }

    public function hapus($tableName, $columnName, $id)
    {
        return DB::table($tableName)->where($columnName, $id)->delete();
    }

    public function tambahDapatId($tableName, $data)
    {
        return DB::table($tableName)->insertGetId($data);
    }

    public function kurangiStok($IDBuku)
    {
        return DB::table('buku')->where('IDBuku', $IDBuku)->decrement('Stok');
    }

     public function tambahStok($IDBuku)
    {
        return DB::table('buku')->where('IDBuku', $IDBuku)->increment('Stok');
    }

        public function tampilPeminjaman()
    {
        return DB::table('peminjaman')
                 ->join('siswa', 'peminjaman.IDSiswa', '=', 'siswa.IDSiswa')
                 ->join('karyawan', 'peminjaman.IDKaryawan', '=', 'karyawan.IDKaryawan')
                 ->join('detailpeminjaman', 'peminjaman.IDPeminjaman', '=', 'detailpeminjaman.IDPeminjaman')
                 ->join('buku', 'detailpeminjaman.IDBuku', '=', 'buku.IDBuku')
                 ->select('peminjaman.*', 'siswa.NamaSiswa', 'karyawan.NamaKaryawan', 'buku.JudulBuku')
                 ->get();
    }

        public function tampilDenda()
    {
        return DB::table('denda')
                 ->join('peminjaman', 'denda.IDPeminjaman', '=', 'peminjaman.IDPeminjaman')
                 ->join('siswa', 'peminjaman.IDSiswa', '=', 'siswa.IDSiswa')
                 ->select('denda.*', 'siswa.NamaSiswa')
                 ->get();
    }
}