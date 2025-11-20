<?php

namespace App\Models;

use App\Enums\FoodCategoryEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Prato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pratos';
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
        return $this->belongsTo(Estabelecimento::class, 'estabelecimento_id');
    }

    public function avaliacoes(): MorphMany
    {
        return $this->morphMany(Avaliacao::class, 'model');
    }

    public function averageRate(): Attribute
    {
        return Attribute::make(
            get: function () {
                $this->loadMissing('avaliacoes');
                return round($this->avaliacoes()->avg('nota') ?? 0, 1);
            }
        );
    }

    public function countRate(): Attribute
    {
        return Attribute::make(
            get: function () {
                $this->loadMissing('avaliacoes');
                return $this->avaliacoes->count() ?? 0;
            }
        );
    }

    public function scopePesquisar(Builder $query, string $pesquisa): Builder
    {
        $terms = Str::contains($pesquisa, ',')
            ? array_map('trim', explode(',', $pesquisa))
            : [trim($pesquisa)];

        return $query->where(function ($main) use ($terms) {
            foreach ($terms as $item) {
                $main->orWhere(function ($q) use ($item) {
                    $q->where('nome', 'regexp', $item)
                        ->orWhere('categoria', 'regexp', $item)
                        ->orWhereHas('estabelecimento', function ($s) use ($item) {
                            $s->where('nome', 'regexp', $item)
                                ->orWhere('segmento', 'regexp', $item);
                        });
                });
            }
        });
    }
}
