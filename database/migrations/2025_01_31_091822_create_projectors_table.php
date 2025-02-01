<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projectors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Projector class name
            $table->string('state'); /** @see \EventBasket\EventSource\Projection\ProjectorState */
            $table->string('mode'); /** @see \EventBasket\EventSource\Projection\ProjectorMode */
            $table->uuid('last_position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectors');
    }
};
