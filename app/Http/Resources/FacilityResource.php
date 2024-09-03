<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bed_room' => $this->bed_room,
            'kitchen' => $this->kitchen ? 'Yes' : 'No',
            'bathroom' => $this->bathroom,
            'parking' => $this->parking ? 'Yes' : 'No',
            'balcony' => $this->balcony ? 'Yes' : 'No',
            'rental_floor_id' => $this->rental_floor,
            'rental_floor_name' => $this->rentalFloor?->floor,
            'water_facility' => $this->water_facility ? 'Yes' : 'No',
        ];
    }
}
