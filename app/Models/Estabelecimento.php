<?php

namespace App\Models;

use App\Enums\RestaurantSegmentEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estabelecimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'estabelecimentos';
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

    public function avaliacoes(): MorphMany
    {
        return $this->morphMany(Avaliacao::class, 'model');
    }

    public function averageRate(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->avaliacoes()->avg('nota') ?? 0, 1)
        );
    }

    public function countRate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->avaliacoes->count() ?? 0
        );
    }
}
