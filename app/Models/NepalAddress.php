<?php

namespace App\Models;

use App\Enums\NepalAddressType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NepalAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'parent_id',
    ];

    protected $casts = [
        'type' => NepalAddressType::class
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
