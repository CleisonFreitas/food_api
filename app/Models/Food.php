<?php

namespace App\Models;

use App\Enums\FoodCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected $casts = [
        'image' => 'string',
        'categoria' => FoodCategoryEnum::class,
    ];

    public function estabelecimento(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'estabelecimento_id');
    }
}
