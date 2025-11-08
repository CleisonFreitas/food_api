<?php

use App\Enums\StatusCarrinhoCompraEnun;
use App\Models\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrinhos_de_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->constrained();
            $table->dateTime('data_de_finalizacao')->nullable();
            $table->string('status')->default(StatusCarrinhoCompraEnun::PENDENTE->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrinhos_de_compras');
    }
};