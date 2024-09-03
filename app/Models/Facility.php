<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'bed_room',
        'kitchen',
        'bathroom',
        'parking',
        'balcony',
        'rental_floor',
        'water_facility',
    ];

    public function kotha()
    {
        return $this->belongsTo(Kotha::class);
    }

    public function rentalFloor()
    {
        return $this->belongsTo(RentalFloor::class, 'rental_floor');
    }
}
