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
        Schema::create('dosen', function (Blueprint $table) {
            // Mengatur nidn_dosen sebagai primary key
            $table->string('nidn_dosen',10)->primary(); // NIDN dosen sebagai primary key
            $table->string('nama_dosen', 50); // Nama dosen
            $table->string('email');
            $table->unsignedBigInteger('id_programstudi'); 
            $table->timestamps(); 

            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_programstudi')->references('id_programstudi')->on('programstudi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
