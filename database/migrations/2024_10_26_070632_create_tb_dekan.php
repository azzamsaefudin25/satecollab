<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dekan', function (Blueprint $table) {
            $table->string('nidn_dekan', 18); // Kolom NIDN Dekan
            $table->string('nama_dekan', 50); // Nama dekan
            $table->string('email'); // Foreign key untuk email
            $table->unsignedBigInteger('id_fakultas'); // Foreign key untuk id_fakultas
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Menjadikan 'nidn_dekan' sebagai primary key
            $table->primary('nidn_dekan');

            // Menambahkan foreign key constraints
            $table->foreign('nidn_dekan')->references('nidn')->on('dosen')->onDelete('cascade'); // Merujuk ke nidn di tabel dosen
            $table->foreign('email')->references('email')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dekan');
    }
};
