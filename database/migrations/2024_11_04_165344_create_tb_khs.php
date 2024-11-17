<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->bigIncrements('id_khs');
            $table->string('nim', 14); // Foreign key untuk NIM
            $table->string('kode_mk', 8); // Foreign key untuk kode mata kuliah
            $table->string('status', 20);
            $table->integer('sks');
            $table->string('nilai', 2); 
            $table->integer('bobot'); 
            $table->timestamps(); 

            // Menambahkan foreign key constraints
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('irs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};