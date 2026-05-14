<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->date('meeting_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
        });

        // Initialize with a default schedule (today)
        DB::table('meeting_controls')->where('id', 1)->update([
            'meeting_date' => now()->format('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
        ]);
    }

    public function down(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->dropColumn(['meeting_date', 'start_time', 'end_time']);
        });
    }
};
