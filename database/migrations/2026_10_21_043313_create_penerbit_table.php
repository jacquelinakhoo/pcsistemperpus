<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->id('IDPenerbit');
            $table->string('NamaPenerbit');
            $table->string('Editor');
            $table->string('Alamat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerbit');
    }
};