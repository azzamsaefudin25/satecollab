<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bagianakademik', function (Blueprint $table) {
            $table->string('nip', 18)->primary(); // NIDN bagian akademik sebagai primary key
            $table->string('nama_bagianakademik', 50); // Nama bagian akademik
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_fakultas'); // Referensi ke tabel fakultas
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Menambahkan foreign key constraints
            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagianakademik');
    }
};