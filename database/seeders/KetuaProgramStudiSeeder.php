<?php

namespace Database\Seeders;
use App\Models\Ketuaprogramstudi;
use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetuaProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenData = Dosen::where('email', 'like', 'sunarsih@lecturer.undip.ac.id') 
            ->get(['nidn_dosen as nidn_ketuaprogramstudi', 'nama_dosen as nama_ketuaprogramstudi', 'email']) // Ambil dan sesuaikan nama kolom
            ->toArray();

        // Insert semua data ke tabel dekan
        Ketuaprogramstudi::insert($dosenData);
    }
}
