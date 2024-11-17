<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\DosenPengampu;  // Model DosenPengampu jika diperlukan
use Illuminate\Support\Facades\DB;

class DosenPengampuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil semua dosen
        $dosen = Dosen::all();

        // Ambil semua mata kuliah
        $mataKuliah = MataKuliah::all();

        // Insert data ke tabel dosenpengampu
        foreach ($mataKuliah as $mk) {
            // Tentukan jumlah dosen yang akan di-assign untuk mata kuliah ini (acak antara 2 sampai 5 dosen)
            $jumlahDosen = rand(2, 4);

            // Pilih acak dosen dari daftar dosen yang ada
            $dosenTerpilih = $dosen->random($jumlahDosen);

            // Insert data dosen yang terpilih ke tabel dosenpengampu
            foreach ($dosenTerpilih as $dsn) {
                DosenPengampu::create([
                    'kode_mk' => $mk->kode_mk, // Mengambil kode_mk dari tabel matakuliah
                    'nidn_dosen' => $dsn->nidn_dosen, // Mengambil nidn_dosen dari tabel dosen
                ]);
            }
        }
    }
}
