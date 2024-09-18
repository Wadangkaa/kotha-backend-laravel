<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kotha_id' => $this->kotha_id,
            'number' => $this->number,
            'alternative_number' => $this->alternative_number,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'kotha' => KothaResource::make($this->kotha)
        ];
    }
}
