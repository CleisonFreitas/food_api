<?php

namespace App\Models;

use App\Enums\StatusCarrinhoCompraEnun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarrinhoCompra extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carrinhos_de_compras';

    protected $fillable = [
        'cliente_id',
        'data_de_finalizacao',
        'status',
    ];

    protected $casts = [
        'status' => StatusCarrinhoCompraEnun::class,
        'data_de_finalizacao' => 'datetime'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
