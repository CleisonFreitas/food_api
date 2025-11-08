<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrinho_de_compra_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrinho_id')->constrained('carrinhos_de_compras');
            $table->foreignId('iten_id')->constrained('pratos');
            $table->decimal('valor', 10, 2);
            $table->smallInteger('quantidade')->default(1);
            $table->decimal('valor_desconto', 10, 2)->default(0.0);
            $table->decimal('acrescimo', 10, 2)->default(0.0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrinho_de_compra_itens');
    }
};
