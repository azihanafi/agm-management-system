<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->timestamp('tac_expires_at')->nullable();
        });

        // Initialize first expiration
        DB::table('meeting_controls')->where('id', 1)->update([
            'tac_expires_at' => now()->addMinutes(5)
        ]);
    }

    public function down(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->dropColumn('tac_expires_at');
        });
    }
};
