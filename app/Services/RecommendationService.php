<?php

namespace App\Services;

use App\Models\Kotha;

class RecommendationService
{

    private $priorityList = [
        'district' => 5,
        'price' => 3,
        'purpose' => 2,
        'category' => 2,
        'parking' => 1,
        'water_facility' => 1,
        'kitchen' => 1,
        'negotiable' => 1
    ];

    public function __construct(private $recommendation) {}

    public function recommendedRooms($numberOfRooms)
    {
        $kothas = Kotha::with('facility')->get();

        $similarity_score = [];

        foreach ($kothas as $kotha) {
            $score = $this->calculate_similarity($this->recommendation, $kotha);
            $similarity_score[] = ['kotha' => $kotha, 'score' => $score];
        }

        usort($similarity_score, function ($a, $b) {
            return $b["score"] - $a["score"];
        });

        $similarity_score = array_splice($similarity_score, 0, $numberOfRooms);
        $recommended_rooms = array_column($similarity_score, "kotha");
        return $recommended_rooms;
    }


    private function calculate_similarity($recommendation, $kotha): int
    {
        $similarity = 0;

        if ($recommendation['district'] == $kotha->district_id) {
            $similarity += $this->priorityList['district'];
        }

        if (
            $recommendation['min_price'] <=  $kotha->price &&
            $recommendation['max_price'] >= $kotha->price
        ) {
            $similarity += $this->priorityList['price'];
        }

        if ($recommendation['purpose'] == $kotha->purpose?->value) {
            $similarity += $this->priorityList['purpose'];
        }

        if ($recommendation['category'] == $kotha->category_id) {
            $similarity += $this->priorityList['category'];
        }

        if ($recommendation['parking'] == $kotha->facility->parking) {
            $similarity += $this->priorityList['parking'];
        }

        if ($recommendation['water_facility'] == $kotha->facility->water_facility) {
            $similarity += $this->priorityList['water_facility'];
        }

        if ($recommendation['kitchen'] == $kotha->facility->kitchen) {
            $similarity += $this->priorityList['kitchen'];
        }

        if ($recommendation['negotiable'] == $kotha->negotiable) {
            $similarity += $this->priorityList['negotiable'];
        }

        return $similarity;
    }
}
