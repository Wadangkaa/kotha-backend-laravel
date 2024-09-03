<?php

namespace Database\Factories;

use App\Enums\KothaPurposeEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kotha>
 */
class KothaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryCount = Category::count();
        $userCount = User::count();
        $districtIds = \App\Models\NepalAddress::where('type', \App\Enums\NepalAddressType::DISTRICT)
            ->pluck('id');

        return [
            'user_id' => fake()->numberBetween(1, $userCount),
            'district_id' => fake()->randomElement($districtIds),
            'title' => fake()->paragraph(1),
            'description' => fake()->paragraph,
            'category_id' => fake()->numberBetween(1, $categoryCount),
            'price' => fake()->numberBetween(1000, 100000),
            'negotiable' => fake()->boolean,
            'purpose' => fake()->randomElement(KothaPurposeEnum::cases()),
        ];
    }
}
