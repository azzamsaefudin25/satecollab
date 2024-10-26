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
        Schema::create('dosenpengampu', function (Blueprint $table) {
            // Mengatur nidn_dosen sebagai primary key
            $table->string('nidn_dosenpengampu',18); // NIDN dosen sebagai primary key
            $table->string('nama_dosenpengampu', 50); // Nama dosen
            $table->timestamps(); // Timestamps for created_at and updated_at

            $table->primary('nidn_dosenpengampu');

            // Menambahkan foreign key constraints
            $table->foreign('nidn_dosenpengampu')->references('nidn')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosenpengampu');
    }
};