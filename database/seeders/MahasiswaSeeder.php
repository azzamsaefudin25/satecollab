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
        // Ambil semua User yang memenuhi kriteria
        $users = User::where('email', 'like', '%@students.undip.ac.id')
            ->whereDoesntHave('mahasiswa')
            ->inRandomOrder()
            ->get();
        $pembimbingakademik = PembimbingAkademik::inRandomOrder()->first();

        foreach ($users as $user) {
            if (!Mahasiswa::where('email', $user->email)->exists()) {
                Mahasiswa::create([
                    'nim' => fake()->unique()->numerify('2406012#######'),
                    'nama_mahasiswa' => $user->name,
                    'semester' => fake()->numberBetween(4, 6),
                    'email' => $user->email,
                    'nidn_pembimbingakademik' => $pembimbingakademik->nidn_pembimbingakademik,
                    'id_programstudi' => 1,
                ]);
            }
        }
    }
}
