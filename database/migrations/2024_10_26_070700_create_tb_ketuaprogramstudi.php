<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ketuaprogramstudi', function (Blueprint $table) {
            $table->string('nidn_ketuaprogramstudi', 18); // NIDN ketuaprogramstudi sebagai primary key
            $table->string('nama_ketuaprogramstudi', 50); // Nama ketuaprogramstudi
            $table->unsignedBigInteger('id_programstudi'); // Foreign key untuk id_prodi
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_fakultas'); // Foreign key untuk id_fakultas
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            $table->primary('nidn_ketuaprogramstudi');

            // Menambahkan foreign key constraints
            $table->foreign('nidn_ketuaprogramstudi')->references('nidn')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
            $table->foreign('id_programstudi')->references('id_programstudi')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketuaprogramstudi');
    }
};
