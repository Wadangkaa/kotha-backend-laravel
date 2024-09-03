<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KothaDetailResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'images' => SimpleImageResource::collection($this->images),
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category', CategoryResource::make($this->category)),
            'price' => $this->price,
            'negotiable' => $this->negotiable ? 'Yes' : 'No',
            'purpose' => $this->purpose,
            'facility' => $this->whenLoaded('category', FacilityResource::make($this->facility)),
            'contact' => $this->contact,
            'created_at' => $this->created_at
        ];
    }
}
