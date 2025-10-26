<?php

namespace App\Models;

use App\Enums\RestaurantSegmentEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'restaurantes';
    protected $fillable = [
        'nome',
        'segmento',
    ];

    protected $casts = [
        'segmento' => RestaurantSegmentEnum::class
    ];
}
