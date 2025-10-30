<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RateControl extends Model
{
    protected $table = 'rate_control';

    protected $fillable = [
        'rate',
        'client_id',
    ];

    protected $casts = [
        'rate' => 'float'
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
