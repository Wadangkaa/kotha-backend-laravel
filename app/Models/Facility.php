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
}
