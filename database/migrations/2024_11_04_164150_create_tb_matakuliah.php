<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->string('kode_mk', 8)->primary(); // Primary key untuk kode mata kuliah
            $table->string('nama_mk', 50); // Nama mata kuliah
            $table->integer('semester'); // Jumlah SKS mata kuliah
            $table->integer('sks'); // Jumlah SKS mata kuliah
            $table->string('semester_aktif',10); 
            $table->string('jenis', 10);
            $table->unsignedBigInteger('id_programstudi'); // Referensi ke tabel fakultas
            $table->foreign('id_programstudi')->references('id_programstudi')->on('programstudi')->onDelete('cascade');
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

        });
    }

    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
};