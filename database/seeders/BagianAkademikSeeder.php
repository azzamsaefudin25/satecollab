<?php

namespace Database\Seeders;

use App\Models\BagianAkademik;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagianAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil satu data user
        $user = User::where('email', 'budi@staff.undip.ac.id')->first(); 

        // Periksa apakah data dosen ditemukan
        if ($user) {
            BagianAkademik::create([
                'nip' => '198002052010121001', 
                'nama_bagianakademik' => $user->name, 
                'email' => $user->email, 
                'id_fakultas' => 1,                
            ]);
        } else {
            // Handle jika data dosen tidak ditemukan
            echo "Data tidak ditemukan.\n";
        }
    }
}
