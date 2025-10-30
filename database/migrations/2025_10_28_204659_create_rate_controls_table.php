<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_control', function (Blueprint $table) {
            $table->id();
            $table->float('rate')
                ->comment('this rate will be adaptable to each table that must be evaluated');
            $table->foreignId('client_id')->constrained('clientes');
            $table->morphs('model');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_control');
    }
};
