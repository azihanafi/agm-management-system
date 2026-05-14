<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->foreignId('active_position_id')->nullable()->constrained('positions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->dropForeign(['active_position_id']);
            $table->dropColumn('active_position_id');
        });
    }
};
