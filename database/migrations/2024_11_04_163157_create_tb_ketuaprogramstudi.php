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
            $table->string('nidn_ketuaprogramstudi', 10); // NIDN ketuaprogramstudi sebagai primary key
            $table->string('nama_ketuaprogramstudi', 50); // Nama ketuaprogramstudi
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_programstudi'); 
 
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            $table->primary('nidn_ketuaprogramstudi');

            // Menambahkan foreign key constraints
            $table->foreign('id_programstudi')->references('id_programstudi')->on('programstudi')->onDelete('cascade');
            $table->foreign('nidn_ketuaprogramstudi')->references('nidn_dosen')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('email')->references('email')->on('dosen')->onDelete('cascade');
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
