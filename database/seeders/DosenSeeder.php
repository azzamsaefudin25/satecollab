<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua User yang memenuhi kriteria
        $users = User::where('email', 'like', '%@lecturer.undip.ac.id')
            ->whereDoesntHave('dosen') 
            ->inRandomOrder()
            ->get();

        foreach ($users as $user) {
            if (!Dosen::where('email', $user->email)->exists()) {
                Dosen::create([
                    'nidn_dosen' => fake()->unique()->numerify('00########'), 
                    'nama_dosen' => $user->name,
                    'email' => $user->email,
                    'id_programstudi' => 1, 
                ]);
            }
        }
    }
}
