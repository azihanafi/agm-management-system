<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominee_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('nominator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->boolean('is_disqualified')->default(false);
            $table->boolean('ceo_override')->default(false);
            $table->timestamps();

            // Enforce one nomination per member per position
            $table->unique(['nominator_id', 'position_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
