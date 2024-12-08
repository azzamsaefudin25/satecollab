<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\PembimbingAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua data Mahasiswa
        $mahasiswaList = Mahasiswa::all();

        foreach ($mahasiswaList as $mahasiswa) {
            // Update IPK secara random antara 2.50 hingga 4.00
            $mahasiswa->update([
                'ipk' => $faker->randomFloat(2, 2.50, 3.90),
            ]);
        }
    }
}
