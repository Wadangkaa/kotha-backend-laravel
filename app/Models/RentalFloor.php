<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalFloor extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor'
    ];
}
