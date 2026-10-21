<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('IDBuku');
            $table->string('JudulBuku');
            $table->string('KategoriBuku');
            $table->string('Bahasa');
            $table->string('Cover');
            $table->integer('Stok');
            $table->integer('JumlahHal');
            $table->string('TahunTerbit');
            $table->string('ISBN');
            $table->string('NamaPenulis');
            $table->unsignedBigInteger('IDPenerbit');
            $table->string('LokasiRak');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};