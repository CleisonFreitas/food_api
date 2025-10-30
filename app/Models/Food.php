<?php

namespace App\Models;

use App\Enums\FoodCategoryEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alimentacao';
    protected $fillable = [
        'nome',
        'valor',
        'categoria',
        'image',
        'estabelecimento_id',
    ];

    protected $appends = [
        'average_rate',
        'count_rate',
    ];

    protected $casts = [
        'image' => 'string',
        'categoria' => FoodCategoryEnum::class,
    ];

    public function estabelecimento(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'estabelecimento_id');
    }

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
