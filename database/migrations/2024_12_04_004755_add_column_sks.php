<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->float('ipk')->after('nidn_pembimbingakademik')->nullable();
        $table->integer('jumlah_sks')->after('ipk')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('ipk');
            $table->dropColumn('jumlah_sks');
        });
    }
};
