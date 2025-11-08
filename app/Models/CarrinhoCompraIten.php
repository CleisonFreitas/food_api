<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarrinhoCompraIten extends Model
{
    use HasFactory;

    protected $table = 'carrinho_de_compra_itens';

    protected $fillable = [
        'carrinho_id',
        'iten_id',
        'valor',
        'quantidade',
        'valor_desconto',
        'acrescimo'
    ];

    protected $casts = [
        'valor' => 'float',
        'quantidade' => 'integer',
        'valor_desconto' => 'float',
        'acrescimo' => 'float',
    ];

    public function carrinhoDeCompra(): BelongsTo
    {
        return $this->belongsTo(CarrinhoCompra::class);
    }

    public function iten(): BelongsTo
    {
        return $this->belongsTo(Prato::class);
    }
}
