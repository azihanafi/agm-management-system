<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_controls', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_tac', 6)->default('123456');
            $table->boolean('is_attendance_open')->default(true);
            $table->boolean('is_voting_open')->default(false);
            $table->timestamps();
        });

        // Insert initial setting
        DB::table('meeting_controls')->insert([
            'meeting_tac' => '123456',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('meeting_controls');
    }
};
