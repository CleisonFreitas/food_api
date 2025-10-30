<?php

namespace App\Models;

use App\Enums\RestaurantSegmentEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'restaurantes';
    protected $fillable = [
        'nome',
        'segmento',
    ];

    protected $appends = [
        'average_rate',
        'count_rate',
    ];

    protected $casts = [
        'segmento' => RestaurantSegmentEnum::class
    ];

    public function rates(): MorphMany
    {
        return $this->morphMany(RateControl::class, 'model');
    }

    public function averageRate(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->rates()->avg('rate') ?? 0, 1)
        );
    }

    public function countRate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->rates->count() ?? 0
        );
    }
}
