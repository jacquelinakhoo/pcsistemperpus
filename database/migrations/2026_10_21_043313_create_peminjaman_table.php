<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('IDPeminjaman');
            $table->unsignedBigInteger('IDSiswa');
            $table->unsignedBigInteger('IDKaryawan'); // Changed from IDPetugas
            $table->dateTime('TglPeminjaman');
            $table->string('Status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};