<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserQuery extends Model
{
    public function pull($tableName, $conditions)
    {
        return DB::table($tableName)
                        ->where($conditions)
                        ->first();
    }

    public function tampil($tableName)
    {
        return DB::table($tableName)->get();
    }

    public function tambah($tableName, $data)
    {
        return DB::table($tableName)->insert($data);
    }

    public function edit($tablename, $data, $IDBuku)
    {
        return DB::table($tablename)->where('IDBuku', $IDBuku)->update($data);
    }

        public function tampilkry($tableName1, $tableName2, $on1, $tableName3)
    {
        return DB::table($tableName)
        ->join()
        ->get();
    }

    public function join()
    {
        return DB::table('karyawan')
        ->join('buku', 'karyawan.IDKaryawan', '=', 'buku.IDKaryawan')
        ->get();
    }
}