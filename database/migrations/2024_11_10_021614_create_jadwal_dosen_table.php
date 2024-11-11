<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_dosen', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->unsignedBigInteger('id_jadwal'); // Foreign key untuk id_jadwal
            $table->string('nidn_dosen', 100); // Foreign key untuk nidn_dosen
            $table->timestamps();

            // Foreign key definition
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwalkuliah')->onDelete('cascade');
            $table->foreign('nidn_dosen')->references('nidn_dosen')->on('dosen')->onDelete('cascade');

            // Unique constraint untuk mencegah duplikat pada kombinasi id_jadwal dan nidn_dosen
            $table->unique(['id_jadwal', 'nidn_dosen']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_dosen');
    }
};
