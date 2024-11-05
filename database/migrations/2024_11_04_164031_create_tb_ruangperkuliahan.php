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
        Schema::create('ruangperkuliahan', function (Blueprint $table) {
            $table->string('kode_ruang', 25)->primary(); // Primary key untuk kode ruang
            $table->string('gedung', 50); // Nama gedung
            $table->integer('kapasitas');
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangperkuliahan');
    }
};