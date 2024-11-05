<?php

namespace Database\Seeders;

use App\Models\PembimbingAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembimbingAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PembimbingAkademik::factory()->count(5)->create();
    }
}
