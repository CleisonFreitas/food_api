<?php

use App\Models\Restaurant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alimentacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->double('valor');
            $table->string('categoria');
            $table->string('image')->nullable();
            $table->foreignIdFor(Restaurant::class, 'estabelecimento_id')
                ->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alimentacao');
    }
};
