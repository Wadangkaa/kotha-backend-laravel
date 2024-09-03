<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image_url = [
            'kotha_images/1.jpg',
            'kotha_images/2.jpg',
            'kotha_images/3.jpg',
            'kotha_images/4.jpg',
            'kotha_images/5.jpg',
            'kotha_images/6.jpg',
            'kotha_images/7.jpg',
            'kotha_images/8.jpg',
            'kotha_images/9.jpg',
            'kotha_images/10.jpg',
            'kotha_images/11.jpg',
            'kotha_images/12.jpg'
        ];
        return [
            'image_url' => $image_url[array_rand($image_url)],
        ];
    }
}
