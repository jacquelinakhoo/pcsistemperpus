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
}