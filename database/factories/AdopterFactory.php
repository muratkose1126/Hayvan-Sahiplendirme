<?php

namespace Database\Factories;

use App\Enums\SexType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adopter>
 */
class AdopterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'identity_number' => fake()->randomNumber(9),
            'birth_date' => fake()->date("Y-m-d", "31-12-2000"),
            'fullname' => fake()->name(),
            'sex' => fake()->randomElement(SexType::cases()),
            'email' => fake()->unique()->email(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }
}
