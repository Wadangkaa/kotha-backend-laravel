<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Single Room',
            ],
            [
                'name' => 'Double Room',
            ],
            [
                'name' => 'Flat',
            ],
            [
                'name' => 'Apartment',
            ],
            [
                'name' => 'House',
            ],
            [
                'name' => '1 BHK',
            ],
            [
                'name' => '2 BHK',
            ],
            [
                'name' => '3 BHK',
            ],
            [
                'name' => '4 BHK',
            ]
        ];
        foreach ($data as $category) {
            Category::updateOrCreate($category);
        }
    }
}
