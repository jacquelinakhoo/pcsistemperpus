<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('IDSiswa');
            $table->string('NamaSiswa');
            $table->string('Rombel');
            $table->string('NIS');
            $table->unsignedBigInteger('IDUser');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};