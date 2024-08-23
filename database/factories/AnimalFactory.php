<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
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
        $breeds = Breed::inRandomOrder()->get();
        $breed = $breeds->shift();
        return [
            "name"=>fake()->monthName(),
            "species_id"=>$spe ?? Species::factory(),
            "breed_id"=>$breed ?? Breed::factory(),
            "color"=>fake()->colorName(),
            "age"=>fake()->randomDigitNotZero(),
            "gender"=>fake()->randomElement(["male","female"]),
            "status"=>fake()->randomElement(["new","pending","published","adopted"]),
            "desexed"=>fake()->boolean(),
            "microchip_number"=>fake()->ean13(),
            "ear_tag_number"=>fake()->ean8(),
            "description"=>fake()->words(20,true),
        ];
    }
}
