<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudis = [
            ['nama_programstudi' => 'Informatika', 'id_fakultas' => 1],
            ['nama_programstudi' => 'Matematika', 'id_fakultas' => 1],
            ['nama_programstudi' => 'Statistika', 'id_fakultas' => 1],
        ];

        foreach ($programStudis as $programStudiData) {
            $programStudi = new ProgramStudi();
            $programStudi->nama_programstudi = $programStudiData['nama_programstudi'];
            $programStudi->id_fakultas = $programStudiData['id_fakultas'];
            $programStudi->save();
        }
    }
}
