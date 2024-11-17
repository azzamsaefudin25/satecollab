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
        Schema::table('jadwalkuliah', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['nidn_dosen1']);
            $table->dropForeign(['nidn_dosen2']);
            $table->dropForeign(['nidn_dosen3']);
            $table->dropForeign(['nidn_dosen4']);
            $table->dropForeign(['nidn_dosen5']);
            
            $table->foreign('nidn_dosen1')->references('nidn_dosen')->on('dosenpengampu')->onDelete('set null');
            $table->foreign('nidn_dosen2')->references('nidn_dosen')->on('dosenpengampu')->onDelete('set null');
            $table->foreign('nidn_dosen3')->references('nidn_dosen')->on('dosenpengampu')->onDelete('set null');
            $table->foreign('nidn_dosen4')->references('nidn_dosen')->on('dosenpengampu')->onDelete('set null');
            $table->foreign('nidn_dosen5')->references('nidn_dosen')->on('dosenpengampu')->onDelete('set null');         
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwalkuliah', function (Blueprint $table) {
            // Hapus foreign key baru
            $table->dropForeign(['nidn_dosen1']);
            $table->dropForeign(['nidn_dosen2']);
            $table->dropForeign(['nidn_dosen3']);
            $table->dropForeign(['nidn_dosen4']);
            $table->dropForeign(['nidn_dosen5']);
            
            $table->foreign('nidn_dosen1')->references('nidn')->on('dosen')->onDelete('set null');
            $table->foreign('nidn_dosen2')->references('nidn')->on('dosen')->onDelete('set null');
            $table->foreign('nidn_dosen3')->references('nidn')->on('dosen')->onDelete('set null');
            $table->foreign('nidn_dosen4')->references('nidn')->on('dosen')->onDelete('set null');
            $table->foreign('nidn_dosen5')->references('nidn')->on('dosen')->onDelete('set null');
   
        });
    }
};
