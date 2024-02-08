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
            $table->integer('status');
            $table->integer('overtime_status');
            $table->string('avatar');
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
