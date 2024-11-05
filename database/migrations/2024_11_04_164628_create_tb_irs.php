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
            $table->string('kode_mk', 8); // Foreign key untuk kode mata kuliah
            $table->string('nama_kelas', 10); // Foreign key untuk nama kelas
            $table->integer('sks');
            $table->string('kode_ruang', 25); // Foreign key untuk kode ruang
            $table->string('status', 25);
            $table->string('hari', 10); // Hari perkuliahan
            $table->time('jam_mulai'); // Jam perkuliahan
            $table->time('jam_selesai')->nullable();
            $table->string('nidn_dosen', 10);
            $table->string('nidn_pembimbingakademik', 10);
            $table->string('status_approve')->default('menunggu konfirmasi');
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Menambahkan foreign key constraints
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('jadwalkuliah')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('jadwalkuliah')->onDelete('cascade');
            $table->foreign('nama_kelas')->references('nama_kelas')->on('jadwalkuliah')->onDelete('cascade');
            $table->foreign('nidn_dosen')->references('nidn_dosen')->on('jadwalkuliah')->onDelete('cascade');
            $table->foreign('nidn_pembimbingakademik')->references('nidn_pembimbingakademik')->on('pembimbingakademik')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('irs');
    }
};