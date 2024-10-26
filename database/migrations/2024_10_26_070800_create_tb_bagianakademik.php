<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bagianakademik', function (Blueprint $table) {
            $table->string('nidn_bagianakademik', 18); // NIDN bagian akademik sebagai primary key
            $table->string('nama_bagianakademik', 50); // Nama bagian akademik
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_fakultas'); // Foreign key untuk id_fakultas
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            $table->primary('nidn_bagianakademik');

            // Menambahkan foreign key constraints
            $table->foreign('nidn_bagianakademik')->references('nidn')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagianakademik');
    }
};