<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fakultas = new Fakultas();
        $fakultas -> nama_fakultas = 'Fakultas Sains dan Matematika';
        $fakultas -> save();
    }
}
