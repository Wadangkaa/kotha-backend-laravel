<?php

namespace Database\Factories;

use App\Models\RentalFloor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rentalFloorCount = RentalFloor::count();
        return [
            'bed_room' => fake()->numberBetween(1, 5),
            'kitchen' => fake()->boolean,
            'bathroom' => fake()->numberBetween(1, 3),
            'parking' => fake()->boolean,
            'balcony' => fake()->boolean,
            'rental_floor' => fake()->numberBetween(1, $rentalFloorCount),
            'water_facility'  => fake()->boolean,
        ];
    }
}
