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
        Schema::create('pengalokasianruang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruang', 25);
            $table->unsignedBigInteger('id_programstudi');
            $table->string('status')->default('menunggu konfirmasi');
            $table->foreign('id_programstudi')->references('id_programstudi')->on('program_studi')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('ruangperkuliahan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalokasianruang');
    }
};
