<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = ['A', 'B', 'C', 'D'];

        // Looping untuk memasukkan setiap kelas
        foreach ($kelas as $namaKelas) {
            Kelas::create([
                'nama_kelas' => $namaKelas,
            ]);
        }
    }
}
