<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Adopter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdoptionRequest>
 */
class AdoptionRequestFactory extends Factory
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
            'status'=>fake()->randomElement(["new","pending","reject","complete"]),
        ];
    }
}
