<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteOTP extends Model
{
    use HasFactory;

    protected $table = 'cliente_otps';

    protected $fillable = [
        'cliente_id',
        'codigo',
        'ativo_ate',
    ];

    protected $casts = [
        'cliente_id' => 'integer',
        'ativo_ate' => 'datetime'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
