<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembimbingakademik', function (Blueprint $table) {
            $table->string('nidn_pembimbingakademik', 10); // NIDN pembimbing akademik sebagai primary key
            $table->string('nama_pembimbingakademik', 50); // Nama pembimbing akademik
            $table->string('email'); // Foreign key untuk email
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update


            $table->primary('nidn_pembimbingakademik');
            // Menambahkan foreign key constraints
            $table->foreign('nidn_pembimbingakademik')->references('nidn_dosen')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('email')->references('email')->on('dosen')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembimbingakademik');
    }
};
