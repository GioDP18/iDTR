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
        Schema::create('am_daily_time_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->time('arrival_am');
            $table->time('departure_am')->nullable();
            $table->time('late_am')->nullable();
            $table->time('hours_worked_am')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('am_daily_time_records');
    }
};
