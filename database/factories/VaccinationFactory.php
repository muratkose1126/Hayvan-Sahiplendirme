<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccination>
 */
class VaccinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $animals = Animal::inRandomOrder()->get();
        $animal = $animals->shift() ?? Animal::factory();
        $vaccines = Vaccine::inRandomOrder()->get();
        $vaccine = $vaccines->shift() ?? Vaccine::factory();
        return [
            'animal_id' => $animal,
            'vaccine_id' => $vaccine,
            'date' => now(),
            'expiration_date' => now()->addDays($vaccine->validity_period),
        ];
    }
}
