<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->string('nim', 14); // Foreign key untuk NIM
            $table->string('nilai', 2); // Nilai (misalnya, 3.75)
            $table->string('kode_mk', 8); // Foreign key untuk kode mata kuliah
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Menambahkan foreign key constraints
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};