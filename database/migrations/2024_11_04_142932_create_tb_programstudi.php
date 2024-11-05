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
        Schema::create('programstudi', function (Blueprint $table) {
            // Primary key untuk program studi
            $table->id('id_programstudi'); // Auto-incrementing id
            $table->string('nama_programstudi',50); // Nama program studi

            // Foreign key untuk fakultas
            $table->unsignedBigInteger('id_fakultas'); // Referensi ke tabel fakultas
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programstudi');
    }
};