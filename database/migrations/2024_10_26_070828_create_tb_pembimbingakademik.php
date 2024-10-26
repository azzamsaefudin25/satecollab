<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembimbingakademik', function (Blueprint $table) {
            $table->string('nidn_pembimbingakademik', 18)->primary(); // NIDN pembimbing akademik sebagai primary key
            $table->string('nama_pembimbingakademik', 50); // Nama pembimbing akademik
            $table->unsignedBigInteger('id_programstudi'); // Foreign key untuk id_programstudi
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_fakultas'); // Foreign key untuk id_fakultas
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            $table->primary('nidn_pembimbingakademik');

            // Menambahkan foreign key constraints
            $table->foreign('nidn_pembimbingakademik')->references('nidn')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('id_programstudi')->references('id_programstudi')->on('program_studi')->onDelete('cascade');
            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembimbingakademik');
    }
};
