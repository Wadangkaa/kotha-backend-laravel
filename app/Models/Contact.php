<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'alternative_number',
        'longitude',
        'latitude',
    ];

    public function scopeWithinRadius($query, $latitude, $longitude, $radius)
    {
        $radius = (float)$radius / 1000;
        $latitude = (float)$latitude;
        $longitude = (float)$longitude;

        return $query->selectRaw(
            "*, (
                6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )
            ) AS distance",
            [$latitude, $longitude, $latitude]
        )->having('distance', '<=', $radius);
    }

    public function kotha(): BelongsTo
    {
        return $this->belongsTo(Kotha::class);
    }
}
