<?php

namespace Database\Seeders;

use App\Models\Adoptable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdoptableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adoptable::factory(10)->create();
    }
}
