<?php

namespace Database\Seeders;

use App\Models\AdoptionRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdoptionRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        AdoptionRequest::factory(10)->create();
    }
}
