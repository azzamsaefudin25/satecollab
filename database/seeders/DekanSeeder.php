<?php

namespace Database\Seeders;

use App\Models\Dekan;
use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenData = Dosen::where('email', 'like', 'aris.widodo@lecturer.undip.ac.id') 
            ->get(['nidn_dosen as nidn_dekan', 'nama_dosen as nama_dekan', 'email']) // Ambil dan sesuaikan nama kolom
            ->toArray();

        // Insert semua data ke tabel dekan
        Dekan::insert($dosenData);
    }
}
