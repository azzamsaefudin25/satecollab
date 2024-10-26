<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim', 14)->primary(); // NIM sebagai primary key
            $table->string('nama_mahasiswa', 50); // Nama mahasiswa
            $table->integer('semester'); // Semester
            $table->string('email'); // Foreign key untuk email
            $table->string('nidn_pembimbingakademik', 18);
            $table->unsignedBigInteger('id_programstudi'); 
            $table->unsignedBigInteger('id_fakultas'); 
            $table->timestamps(); 

            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('nidn_pembimbingakademik')->references('nidn_pembimbingakademik')->on('pembimbingakademik')->onDelete('cascade');
            $table->foreign('id_programstudi')->references('id_programstudi')->on('program_studi')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};