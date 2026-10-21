<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detailpeminjaman', function (Blueprint $table) {
            $table->id('IDDetail');
            $table->unsignedBigInteger('IDPeminjaman');
            $table->unsignedBigInteger('IDBuku');
            $table->integer('Jumlah');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detailpeminjaman');
    }
};