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
        Schema::create('paperwork_itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paperwork_id')->constrained()->onDelete('cascade');
            $table->string('time');
            $table->string('activity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paperwork_itinerary_items');
    }
};
