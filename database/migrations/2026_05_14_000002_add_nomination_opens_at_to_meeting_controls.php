<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->date('nomination_opens_at')->nullable()->after('end_time');
        });
    }

    public function down(): void
    {
        Schema::table('meeting_controls', function (Blueprint $table) {
            $table->dropColumn('nomination_opens_at');
        });
    }
};
