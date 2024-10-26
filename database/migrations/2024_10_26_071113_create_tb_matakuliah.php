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
            $table->string('jenis', 10);
            $table->string('nidn_dosenpengampu', 18);
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            $table->foreign('nidn_dosenpengampu')->references('nidn_dosenpengampu')->on('dosenpengampu')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
};