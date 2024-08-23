<?php

namespace Database\Seeders;

use App\Models\Adopted;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdoptedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Adopted::factory(10)->create();
    }
}
