<?php

namespace Database\Factories;

use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $species = Species::inRandomOrder()->get();
        $spe = $species->shift();
        return [
            'name' => fake()->word(),
            'species_id' => $spe ?? Species::factory()
        ];
    }
}
