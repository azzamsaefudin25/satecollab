<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwalkuliah', function (Blueprint $table) {
            $table->bigIncrements('id_jadwal');; // ID unik untuk setiap jadwal kuliah
            $table->string('kode_mk', 8); // Foreign key untuk kode mata kuliah
            $table->string('kode_ruang', 25); // Foreign key untuk kode ruang
            $table->string('nama_kelas', 10); // Foreign key untuk nama kelas
            $table->integer('semester');
            $table->integer('sks'); // Jumlah SKS mata kuliah
            $table->string('jenis', 10);
            $table->string('semester_aktif',10);
            $table->string('hari', 10); // Hari perkuliahan
            $table->time('jam_mulai'); // Jam perkuliahan
            $table->time('jam_selesai')->nullable();
            $table->string('status')->default('menunggu konfirmasi');
            $table->timestamps(); // Untuk mencatat waktu pembuatan dan update

            // Definisi foreign key
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah')->onDelete('cascade');
            $table->foreign('kode_ruang')->references('kode_ruang')->on('pengalokasianruang')->onDelete('cascade');
            $table->foreign('nama_kelas')->references('nama_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwalkuliah');
    }
};
