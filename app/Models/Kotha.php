<?php

namespace App\Models;

use App\Enums\KothaPurposeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kotha extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'negotiable',
        'purpose',
        'district_id',
        'user_id',
    ];

    protected $casts = [
        'purpose' => KothaPurposeEnum::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function facility(): HasOne
    {
        return $this->hasOne(Facility::class, 'kotha_id');
    }
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class, 'kotha_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'kotha_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(NepalAddress::class, 'district_id');
    }
}
