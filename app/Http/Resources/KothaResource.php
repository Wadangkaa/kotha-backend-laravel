<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KothaResource extends JsonResource
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
            'negotiable' => $this->negotiable,
            'status' => $this->status,
            'status_name' => $this->status?->name,
            'purpose' => $this->purpose,
            'district' => $this->district?->only('id', 'name'),
            'created_at' => $this->created_at
        ];
    }
}
