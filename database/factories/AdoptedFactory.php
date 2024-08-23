<?php

namespace Database\Factories;

use App\Models\Adopter;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adopted>
 */
class AdoptedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $adopters = Adopter::inRandomOrder()->get();
        $adopter = $adopters->shift() ?? Adopter::factory();
        $animals = Animal::inRandomOrder()->get();
        $animal = $animals->shift() ?? Animal::factory();
        return [
            'adopter_id' => $adopter,
            'animal_id' => $animal,
        ];
    }
}
