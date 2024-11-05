<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Dosen;
use App\Models\PembimbingAkademik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembimbingAkademik>
 */
class PembimbingAkademikFactory extends Factory
{
    protected $model = PembimbingAkademik::class;

    public function definition(): array
    {
        // Mengambil dosen yang belum memiliki relasi dengan PembimbingAkademik (berdasarkan nidn)
        $dosen = Dosen::whereDoesntHave('pembimbingakademik') // Pastikan dosen belum ada di tabel PembimbingAkademik
            ->inRandomOrder()
            ->first();

        // Jika tidak ada dosen yang tersedia, bisa mengembalikan nilai default atau menangani null case
        if (!$dosen) {
            return [];
        }

        return [
            'nidn_pembimbingakademik' => $dosen->nidn_dosen, // NIDN unik dari dosen
            'nama_pembimbingakademik' => $dosen->nama_dosen, // Nama dosen yang diambil dari tabel Dosen
            'email' => $dosen->email, // Email dosen
        ];
    }
}
