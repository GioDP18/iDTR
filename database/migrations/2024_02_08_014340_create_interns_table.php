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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('gender');
            $table->string('birthdate');
            $table->string('email');
            $table->integer('status')->default(0);
            $table->integer('break_time_status')->default(0);
            $table->string('avatar')->nullable();   
            $table->time('target_hours')->default('00:00:00');
            $table->time('completed_hours')->default('00:00:00');
            $table->time('remaining_hours')->default('00:00:00');
            $table->time('total_hours_worked_am')->default('00:00:00');
            $table->time('total_hours_worked_pm')->default('00:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
