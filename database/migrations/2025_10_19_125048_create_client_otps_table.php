<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente_otps', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 4);
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->dateTime('ativo_ate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente_otps');
    }
};
