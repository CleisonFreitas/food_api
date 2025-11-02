<?php

use App\Models\Estabelecimento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pratos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->double('valor');
            $table->string('categoria');
            $table->string('image')->nullable();
            $table->foreignId('estabelecimento_id')
                ->constrained('estabelecimentos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pratos');
    }
};
