<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('IDKaryawan');
            $table->string('NamaKaryawan');
            $table->string('NoTelp_K');
            $table->string('Jabatan');
            $table->string('SesiKerja');
            $table->unsignedBigInteger('IDUser');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};