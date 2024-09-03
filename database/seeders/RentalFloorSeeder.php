<?php

namespace Database\Seeders;

use App\Models\RentalFloor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalFloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['ground floor', 'first floor', 'second floor', 'top floor'];
        foreach ($data as $floor) {
            RentalFloor::updateOrCreate(['floor' => $floor]);
        }
    }
}
