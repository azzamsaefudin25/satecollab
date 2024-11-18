<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInTableName extends Migration
{
    public function up()
    {
        Schema::table('jadwalkuliah', function (Blueprint $table) {
            $table->renameColumn('jumlah_pendaftar', 'terisi');
        });
    }

    public function down()
    {
        Schema::table('jadwalkuliah', function (Blueprint $table) {
            $table->renameColumn('terisi', 'jumlah_pendaftar');
        });
    }
}
