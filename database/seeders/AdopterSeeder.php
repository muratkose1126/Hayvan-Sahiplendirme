<?php

namespace Database\Seeders;

use App\Models\Adopter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdopterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adopter::factory(10)->create();
    }
}
