<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('irs', function (Blueprint $table) {
            $table->string('nim', 14); // Foreign key untuk NIM
            $table->string('kode_ruang', 25); // Foreign key untuk kode ruang
            $table->string('kode_mk', 8); // Foreign key untuk kode mata kuliah
            $table->string('nama_kelas', 10); // Foreign key untuk nama kelas
            $table->string('status', 25);
            $table->string('status_approve')->default('menunggu konfirmasi');
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Menambahkan foreign key constraints
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('ruangperkuliahan')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('nama_kelas')->references('nama_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};