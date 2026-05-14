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
        Schema::create('paperworks', function (Blueprint $table) {
            $table->id();
            $table->string('kepada');
            $table->string('sk')->nullable();
            $table->string('daripada');
            $table->date('tarikh');
            $table->string('perkara');
            
            // Objective Section
            $table->string('program_title');
            $table->date('program_date');
            $table->string('program_day');
            $table->string('program_time');
            $table->string('program_location');
            
            // Requirement Modules
            $table->text('syarat_penyertaan')->nullable();
            $table->text('cadangan_syarat')->nullable();
            
            // Workflow Status
            $table->string('status')->default('draft'); // draft, submitted, level1_approved, level2_approved, level3_approved, approved, rejected
            $table->integer('current_level')->default(1);
            $table->text('comments')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paperworks');
    }
};
