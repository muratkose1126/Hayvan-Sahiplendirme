<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vaccination::factory(10)->create();
    }
}
