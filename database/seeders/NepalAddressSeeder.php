<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NepalAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('database\nepal_location.json');

        $data = json_decode($json, true);

        if (!$data){
            dd('No data found');
        }

        $provinces = $data['provinceList'];
        foreach ($provinces as $province) {
            $newProvince = \App\Models\NepalAddress::updateOrCreate([
                'name' => strtolower($province['name']),
                'type' => \App\Enums\NepalAddressType::PROVINCE,
            ]);

            foreach($province['districtList'] as $district){
                $newProvince->districts()->updateOrCreate([
                    'name' => strtolower($district['name']),
                    'type' => \App\Enums\NepalAddressType::DISTRICT,
                ]);
            }
        }
    }
}
