<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('IDUser');
            $table->string('Username');
            $table->string('Password');
            $table->string('Role');
            $table->string('EmailUser');
            $table->string('Gender');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};