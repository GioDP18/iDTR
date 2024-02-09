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
        Schema::create('pm_daily_time_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interns_id')->constrained();
            $table->time('arrival_pm');
            $table->time('departure_pm');
            $table->time('late_pm');
            $table->time('hours_worked_pm');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_daily_time_records');
    }
};
