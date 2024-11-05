<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\PembimbingAkademik;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

// class MahasiswaFactory extends Factory
// {
//     protected $model = Mahasiswa::class;

//     public function definition()
//     {
        
//         $user = User::where('email', 'like', '%@students.undip.ac.id')
//             ->whereDoesntHave('mahasiswa') // Pastikan belum digunakan di tabel dosen
//             ->inRandomOrder()
//             ->first();
//         $pembimbingakademik = PembimbingAkademik::inRandomOrder()->first();

//         return [
//             'nim' => $this->faker->unique()->numerify('24060122######'), // 14 karakter
//             'nama_mahasiswa' => $user->name,
//             'semester' => $this->faker->numberBetween(4, 6),
//             'email' => $user->email, // Menggunakan email dari user yang baru dibuat
//             'nidn_pembimbingakademik' => $pembimbingakademik->nidn_pembimbingakademik,
//             'id_programstudi' => 1,
//         ];
//     }
// }
