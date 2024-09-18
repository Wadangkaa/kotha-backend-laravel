<?php

namespace Database\Factories;

use App\Models\Kotha;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // Kathmandu coordinates
        $kathmanduLat = 27.693771;
        $kathmanduLng = 85.329209;

        // Define the range (in degrees)
        $latRange = 0.05;  // 0.05 degrees ~ 5.5 km
        $lngRange = 0.05;  // 0.05 degrees ~ 4.8 km

        return [
            'number' => $this->faker->phoneNumber,
            'alternative_number' => $this->faker->phoneNumber,
            'longitude' => $this->faker->latitude($kathmanduLng - $lngRange, $kathmanduLng + $lngRange),
            'latitude' => $this->faker->latitude($kathmanduLat - $latRange, $kathmanduLat + $latRange),
        ];
    }
}
