<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'nota',
        'cliente_id',
    ];

    protected $casts = [
        'nota' => 'float'
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
