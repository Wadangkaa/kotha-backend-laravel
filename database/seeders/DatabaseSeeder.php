<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Facility;
use App\Models\Image;
use App\Models\Kotha;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\KothaFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            RentalFloorSeeder::class,
            NepalAddressSeeder::class
        ]);

        Kotha::factory(10)
            ->has(Facility::factory(), 'facility')
            ->has(Contact::factory(), 'contact')
            ->has(Image::factory()->count(3), 'images')
            ->create();
    }
}
