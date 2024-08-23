<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adoptable>
 */
class AdoptableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $animals = Animal::inRandomOrder()->get();
        $animal = $animals->shift();
        return [
            "animal_id" => $animal,
            "is_published" => fake()->boolean(),
            "publish_date" => now(),
            "expiration_date" => now()->addDays(30),

        ];
    }
}
